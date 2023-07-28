var timeInput = document.getElementById('estimated_time');
var suggestionContainer = document.getElementById('suggestionContainer');

  if (timeInput) {
    timeInput.addEventListener('input', () => {
      var enteredTime = timeInput.value;
      var suggestions = generateTimeSuggestions(enteredTime);
    
      suggestionContainer.innerHTML = '';
    
      suggestions.forEach((suggestion) => {
        var suggestionOption = document.createElement('div');
        suggestionOption.textContent = suggestion;
        suggestionOption.addEventListener('click', () => {
          timeInput.value = suggestion;
          suggestionContainer.innerHTML = '';
          timeInput.focus();
    
        });
        suggestionContainer.appendChild(suggestionOption);
      });
    });
  }

  function gentime(event){
    var step = parseInt($(event.target).attr('data-id'));
    var enteredTimeEdit =  $("#estimated_stime"+step).val();
    var enteredTimeEditInput =  $("#estimated_stime"+step);
    var suggestionContainerEdit = $("#suggestionSContainer"+step);
    var suggestionsEdit = generateTimeSuggestions(enteredTimeEdit);

    suggestionContainerEdit.empty(); // Clear the container before adding new suggestions.

    suggestionsEdit.forEach((suggestionEdit) => {
      var suggestionOptionEdit = $("<div></div>");
      suggestionOptionEdit.text(suggestionEdit);
      suggestionOptionEdit.on('click', function() {
        enteredTimeEditInput.val(suggestionEdit);
        suggestionContainerEdit.empty();
        enteredTimeEditInput.focus();
      });
      suggestionContainerEdit.append(suggestionOptionEdit);
    });
  }

function generateTimeSuggestions(enteredTime) {
  const suggestions = [];
  const currentTime = new Date();
  const currentHour = currentTime.getHours();
  const currentMinute = currentTime.getMinutes();

  if (enteredTime.includes('h')) {
    const [enteredHour, enteredMinute] = enteredTime.split('h');
    const hourSuggestions = generateHourSuggestions(enteredHour);
    const minuteSuggestions = generateMinuteSuggestions(enteredMinute);
    // const allval= hourSuggestions + '' +minuteSuggestions;
    var combinedArray = [];

    for (var i = 0; i < hourSuggestions.length; i++) {
        for (var j = 0; j < minuteSuggestions.length; j++) {
            var combinedString = hourSuggestions[i] + ' ' +  minuteSuggestions[j];
            combinedArray.push(combinedString);
        }
    }

    suggestions.push(...combinedArray);
    // suggestions.push(...hourSuggestions);

  } else {
    const hourSuggestions = generateHourSuggestions(enteredTime);
    suggestions.push(...hourSuggestions);
  }

  return suggestions;
}

function generateHourSuggestions(enteredHour) {
  const suggestions = [];
  const hours = [];

  if (enteredHour && enteredHour != "") {
    for (let i = 0; i <= enteredHour+100; i++) {
      hours.push(i.toString().padStart(1, '0'));
    }
  
    suggestions.push(...hours.filter((hour) => hour.startsWith(enteredHour)).map((hour) => hour + 'h'));
  }

  return suggestions;
}

function generateMinuteSuggestions(enteredMinute) {
  const suggestions = [];
  const minutes = [];

  for (let i = 0; i < 60; i ++) {
    minutes.push(i.toString().padStart(1, '0'));
  }

  suggestions.push(...minutes.filter((minute) => minute.startsWith(enteredMinute)).map((minute) => minute + 'm'));

  return suggestions;
}



