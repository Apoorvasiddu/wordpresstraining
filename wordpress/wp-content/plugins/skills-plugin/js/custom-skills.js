jQuery(document).ready(function ($) {
    var user_id = csp_ajax_object.user_id;
    $('#csp-skill-modal').show();
    fetchSkills();

    function fetchSkills() {
        $('#csp-loader').show();
        $.ajax({
            url: csp_ajax_object.get_url,
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                const skillTableBody = $('#csp-skill-table tbody');
                skillTableBody.empty();
                const size = Object.keys(response).length;
                if(size > 0){
                    response.forEach(skill => {
                        const skillRow = `
                            <tr>
                                <td>${skill.skill_name}</td>
                                <td>${skill.ratings}</td>
                                <td><button class="edit-skill-btn" data-id="${skill.Id}"><i class='fa fa-edit'></i><span class="tooltip">Edit</span></button></td>
                                <td><button class="delete-skill-btn" data-id="${skill.Id}"><i class="fa fa-trash"><span class="tooltip">Delete</span></button></td>
                            </tr>
                        `;
                        skillTableBody.append(skillRow);
                    }); 
                } else {
                    const skillRow = `
                        <tr>
                            <td colspan="4">No skills found. Please add your first skill.</td>
                        </tr> `;
                    skillTableBody.append(skillRow);
                }
                $('#csp-loader').hide();
            },
            error: function (error) {
                console.log('Error fetching skills:', error);
            }
        });
    }

    $('.csp-close-modal').click(function () {
        window.location.href = csp_ajax_object.home_url;
    });

    // Save skill
    $(document).on('click', '.edit_skill', function () {
        $('#csp-loader').show();
        const skill_id = $('#csp-skill-id').val();
        const skill_name = $('#csp-skill-dropdown').val();
        const skill_rating = $('#csp-skill-rating').val();

        $.ajax({
            url: csp_ajax_object.save_url,
            type: 'POST',
            data: {
                skills: [{
                    skill_id,
                    skill_name,
                    skill_rating
                }],
                user_id: user_id
            },
            success: function (response) {
                var text=$('#save_button').text();
                if(text == 'Save'){
                    showConfirmationAlert('Skills Saved successfully!')
                } else {
                    showConfirmationAlert('Skills Updated Successfully!')
                    $('#csp-skill-dropdown').val('').prop('disabled', false);
                    $('#csp-skill-rating').val('');
                    $('#save_button').text('Save');
                    $('#csp-skill-id').val('');
                    $('#modal-title').text('Add Skill');
                    $('.cancel_edit').hide();
                }
                $('#csp-skill-dropdown').val('');
                $('#csp-skill-rating').val('');
                fetchSkills();
                $('#csp-loader').hide();
                closeCustomAlert();
            },
            error: function (error) {
                console.log('Error saving skills:', error);
            }
        });
    });
    $(document).on('click', '#save_button', function() {
        const skill_name = $('#csp-skill-dropdown').val();
        const skill_rating = $('#csp-skill-rating').val();
        var skillExists = false;
        var skillsame = false;
        if(!skill_name || !skill_rating){
            var missingFields = [];
            if (!skill_name) missingFields.push("Skill");
            if (!skill_rating) missingFields.push("Ratings");
            showConfirmationAlert("Please select " + missingFields.join(" and "));
        } else {
            const confirmButton = document.getElementById('confirm');
            confirmButton.classList.remove('delete_skill');
            confirmButton.classList.remove('edit_skill');
            $('#csp-skill-table tbody tr').each(function() {
                var skillNameInTable = $(this).find('td:first').text().trim();
                var skillRatingInTable = $(this).find('td:nth-child(2)').text().trim();
                if (skill_name === skillNameInTable) {
                    if(skill_rating === skillRatingInTable) {
                        skillsame = true;
                    }
                    skillExists = true;
                    return false; // Break the loop once a match is found
                }
            });
            var text=$('#save_button').text();
            if(text == 'Save'){
                if(skillExists) {
                    if(skillsame) {
                        showConfirmationAlert('Skill already exists!')
                    } else {
                        showCustomAlert('Skill already exists. Do you want to update it?')
                    }
                    
                } else {
                    showCustomAlert('Are you sure you want to save this skill?')
                }
                
            } else {
                showCustomAlert('Are you sure you want to edit this skill?')
            }
            
            // const confirmButton = document.getElementById('confirm');
            confirmButton.classList.add('edit_skill');
        }
    });

    // Edit skill
    $(document).on('click', '.edit-skill-btn', function() {
        var row = $(this).closest('tr');
        var skillId = $(this).data('id');
        var skillName = row.find('td:first').text().trim();
        var skillRating = row.find('td:nth-child(2)').text().trim();
        $('#csp-skill-id').val(skillId);
        $('#csp-skill-dropdown').val(skillName);
        $('#csp-skill-rating').val(skillRating);
        $('#csp-skill-dropdown').prop('disabled', true);
        $('#modal-title').text('Edit Skill');
        $('#save_button').text('Edit');
        $('#csp-save-skill-btn').hide();
        $('#csp-edit-skill').show();
        $('#csp-skill-modal').show();
        $('.cancel_edit').show();
    }); 

    $(document).on('click', '.cancel_edit', function() {
        $('#csp-skill-dropdown').val('').prop('disabled', false);
        $('#csp-skill-rating').val('');
        $('#save_button').text('Save');
        $('#csp-skill-id').val('');
        $('#modal-title').text('Add Skill');
        $('.cancel_edit').hide();
    });

    let currentSkillId;
    // Delete skill
    $(document).on('click', '.delete-skill-btn, #modal-delete-btn', function () {
        const confirmButton = document.getElementById('confirm');
        confirmButton.classList.remove('delete_skill');
        confirmButton.classList.remove('edit_skill');
        currentSkillId = $(this).data('id');
        showCustomAlert('Are you sure you want to delete this skill?');
        
        confirmButton.classList.add('delete_skill');
        // Set the skill ID to the confirm button
        confirmButton.setAttribute('data-id', currentSkillId);
    });
    
    // Attach click event to confirm button after setting data-id
    $(document).on('click', '#confirm.delete_skill', function () {
        $('#csp-loader').show();
        var skill_id = currentSkillId;
        alert(skill_id);
    
        $.ajax({
            url: csp_ajax_object.edit_delete_url,
            type: 'POST',
            data: {
                skill_id: skill_id,
                action: 'delete',
                user_id: user_id
            },
            success: function (response) {
                $('#confirm').removeAttr('data-id');
                // Refresh skills
                fetchSkills(); 
                $('#modal-title').text('Add Skill');
                $('#csp-skill-form')[0].reset();
                $('#modal-delete-btn').hide();
                $('#csp-loader').hide();
                closeCustomAlert();
                showConfirmationAlert('Skill Deleted Successfully!');
            },
            error: function (error) {
                console.log('Error deleting skill:', error);
                $('#csp-loader').hide(); // Hide loader on error too
            }
        });
    });
    
    // $.ajax({
    //     url: csp_ajax_object.get_all_skills,
    //     type: 'POST',
    //     data: {
    //         user_id: user_id
    //     },
    //     success: function (response) {
    //         console.log('Fetched skills:', response); // Debugging line
    //         const skillDropdown = $('#csp-skill-dropdown');
    //         skillDropdown.empty();
    //         skillDropdown.append('<option value="" disabled selected>Select a skill</option>');
    //         response.forEach(skill => {
    //             const option = `<option value="${skill.skill_name}">${skill.skill_name}</option>`;
    //             skillDropdown.append(option);
    //         });
    //     },
    //     error: function (error) {
    //         console.log('Error fetching skills:', error); // Debugging line
    //     }
    // });
});

function showCustomAlert(message) {
    document.getElementById('custom-alert-message').innerText = message;
    document.getElementById('custom-alert').style.display = "block";
}

function closeCustomAlert() {
    document.getElementById('custom-alert').style.display = "none";
}

function showConfirmationAlert(message) {
    document.getElementById('confirm-alert-message').innerText = message;
    document.getElementById('confirm-alert').style.display = "block";
}

function closeConfirmAlert() {
    document.getElementById('confirm-alert').style.display = "none";
}
