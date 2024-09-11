jQuery(document).ready(function($) {
    var $skillsInput = $('#um_field_1_skill'); // Replace with the actual input ID
    var $autocompleteList = $('<ul class="autocomplete-list"></ul>').insertAfter($skillsInput);
    
    $skillsInput.on('input', function() {
        var query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: myScriptVars.restUrl + 'skills',
                method: 'POST',
                data: {
                    action: 'fetch_skills',
                    query: query
                },
                success: function(response) {
                    $autocompleteList.empty();
                    if (response) {
                        var skills = JSON.parse(response);
                        skills.forEach(function(skill) {
                            var $skillItem = $('<li>' + skill + '</li>');
                            $skillItem.on('click', function() {
                                $skillsInput.val($(this).text());
                                $autocompleteList.empty();
                            });
                            $autocompleteList.append($skillItem);
                        });
                    }
                }
            });
        } else {
            $autocompleteList.empty();
        }
    });
});
