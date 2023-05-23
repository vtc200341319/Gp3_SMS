function addOption() {
    var optionsContainer = document.getElementById('options-container');

    var optionDiv = document.createElement('div');
    optionDiv.classList.add('option');

    var optionInput = document.createElement('input');
    optionInput.type = 'text';
    optionInput.name = 'option_text[]';
    optionInput.required = true;

    var optionCheckbox = document.createElement('input');
    optionCheckbox.type = 'checkbox';
    optionCheckbox.name = 'is_correct[]';

    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.textContent = 'Remove';
    removeButton.addEventListener('click', function() {
        removeOption(optionDiv);
    });

    optionDiv.appendChild(optionInput);
    optionDiv.appendChild(optionCheckbox);
    optionDiv.appendChild(removeButton);

    optionsContainer.appendChild(optionDiv);
}

function removeOption(optionDiv) {
    var optionsContainer = document.getElementById('options-container');
    optionsContainer.removeChild(optionDiv);
}
