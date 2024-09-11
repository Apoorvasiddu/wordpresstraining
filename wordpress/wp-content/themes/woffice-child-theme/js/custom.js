jQuery(document).ready(function(){
  jQuery("#nav-sidebar-trigger, #nav-trigger").click(function(){
    var owl = jQuery('.owl-carousel').owlCarousel();
    owl.trigger('refresh.owl.carousel');
  })
});

jQuery(document).ready(function(){
  if(".hr-corner-list li:has(> ul)") {
    jQuery(".hr-corner-list li ul").prev().removeAttr("href").css("cursor","pointer");
  }
  jQuery(".hr-corner-list a").on("click", function (e) {
    if (jQuery(this).parent().has("ul")) {
      jQuery(this).next('ul').toggleClass("active").slideToggle();
      }
  });
  jQuery(".hr-corner-list a").each(function() {
    if (jQuery(this).parent().children('ul').size() > 0 ) {
      jQuery(this).append('<span></span>');
    }
  });
  
  // Project Updates widget list dropdown
  if(".project-updates-list li:has(> ul)") {
      jQuery(".project-updates-list li ul").prev().removeAttr("href").css("cursor","pointer");
  }
  jQuery(".project-updates-list a").on("click", function (e) {
      if (jQuery(this).parent().has("ul")) {
      jQuery(this).next('ul').toggleClass("active").slideToggle();
      }
  });
  jQuery(".project-updates-list a").each(function() {
      if (jQuery(this).parent().children('ul').size() > 0 ) {
          jQuery(this).append('<span></span>');
      }
  });

  if(".benefit-modal-content li:has(> ul)") {
    jQuery(".benefit-modal-content li ul").prev().removeAttr("href").addClass("empben-popup-content");
  }
});

/* Back button in individual post to go back to recently visited page */
jQuery(document).ready(function(){
  jQuery('#post-back-btn').on('click', function () {
      window.history.go(-1);
      return false;
  });
});





document.addEventListener('DOMContentLoaded', function () {
  const addSkillBtn = document.getElementById('add-skill');
  const skillTable = document.getElementById('skill-table').querySelector('tbody');
  const saveForm = document.getElementById('save-form');
  const savedSkillsInput = document.getElementById('saved-skills');
  let editingSkillId = null; // Variable to keep track of the skill being edited

  function resetForm() {
      document.getElementById('technology-skill').value = '';
      document.getElementById('skill-rating').value = '';
      addSkillBtn.innerText = 'Add Skill';
      editingSkillId = null;
  }

  function isDuplicateSkill(technologySkill) {
      return Array.from(skillTable.querySelectorAll('tr')).some(row => row.querySelector('td').textContent === technologySkill && row.getAttribute('data-id') !== editingSkillId);
  }

  addSkillBtn.addEventListener('click', function () {
      const technologySkill = document.getElementById('technology-skill').value;
      const skillRating = document.getElementById('skill-rating').value;

      if (technologySkill && skillRating) {
          if (editingSkillId) {
              // Update existing skill
              const row = skillTable.querySelector(`tr[data-id="${editingSkillId}"]`);
              if (row) {
                  row.innerHTML = `
                      <td>${technologySkill}</td>
                      <td>${skillRating}</td>
                      <td>
                          <button type="button" class="edit-skill" data-id="${editingSkillId}" style="border: none; background: none;"><i class="fas fa-edit"></i></button>
                          <button type="button" class="delete-skill" data-id="${editingSkillId}" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
                      </td>
                  `;
                  resetForm(); // Reset form after update
              }
          } else {
              // Check for duplicate skill
              if (isDuplicateSkill(technologySkill)) {
                  alert('This technology skill has already been added.');
                  return;
              }

              // Add new skill
              const row = document.createElement('tr');
              row.setAttribute('data-id', Date.now()); // Temporary ID for the new skill
              row.innerHTML = `
                  <td>${technologySkill}</td>
                  <td>${skillRating}</td>
                  <td>
                      <button type="button" class="edit-skill" data-id="${row.getAttribute('data-id')}" style="border: none; background: none;"><i class="fas fa-edit"></i></button>
                      <button type="button" class="delete-skill" data-id="${row.getAttribute('data-id')}" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
                  </td>
              `;
              skillTable.appendChild(row);
              saveForm.style.display = 'block';
              resetForm(); // Reset form after adding
          }
      } else {
          alert('Please select both a technology skill and a rating.');
      }
  });

  skillTable.addEventListener('click', function (event) {
      const target = event.target.closest('button');
      if (target) {
          const id = target.getAttribute('data-id');
          if (target.classList.contains('delete-skill')) {
              const row = target.closest('tr');
              skillTable.removeChild(row);
              if (skillTable.children.length === 0) {
                  saveForm.style.display = 'none';
              }
          } else if (target.classList.contains('edit-skill')) {
              const row = target.closest('tr');
              const cells = row.children;
              document.getElementById('technology-skill').value = cells[0].textContent;
              document.getElementById('skill-rating').value = cells[1].textContent;
              addSkillBtn.innerText = 'Update Skill';
              editingSkillId = id; // Set the ID of the skill being edited
              saveForm.style.display = 'block';
          }
      }
  });

  saveForm.addEventListener('submit', function (event) {
      event.preventDefault();
      const rows = Array.from(skillTable.children);
      const skills = rows.map(row => {
          const cells = row.children;
          return {
              technology_skill: cells[0].textContent,
              skill_rating: cells[1].textContent,
              id: row.getAttribute('data-id') // Add the ID to track changes
          };
      });

      savedSkillsInput.value = JSON.stringify(skills);
      fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: 'save_skills',
            saved_skills: savedSkillsInput.value
        })
    })
      .then(response => response.text())
      .then(result => {
          alert('Skills saved successfully!');
          window.location.reload(); // Reload the page to fetch and display updated skills
      })
      .catch(error => {
          console.error('Error saving skills:', error);
      });
  });

  function fetchSkills() {
      fetch('path/to/your/endpoint', { // Adjust this path to your endpoint that returns saved skills
          method: 'GET'
      })
      .then(response => response.json())
      .then(data => {
          skillTable.innerHTML = ''; // Clear existing table content
          data.forEach(skill => {
              const row = document.createElement('tr');
              row.setAttribute('data-id', skill.id); // Set the ID of the skill
              row.innerHTML = `
                  <td>${skill.technology_skill}</td>
                  <td>${skill.skill_rating}</td>
                  <td>
                      <button type="button" class="edit-skill" data-id="${skill.id}" style="border: none; background: none;"><i class="fas fa-edit"></i></button>
                      <button type="button" class="delete-skill" data-id="${skill.id}" style="border: none; background: none;"><i class="fas fa-trash"></i></button>
                  </td>
              `;
              skillTable.appendChild(row);
          });
      })
      .catch(error => {
          console.error('Error fetching skills:', error);
      });
  }

  // Fetch and display skills when the page loads
  fetchSkills();
});
