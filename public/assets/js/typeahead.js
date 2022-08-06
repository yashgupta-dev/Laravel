$(function() {
    'use strict'

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            var substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            for (var i = 0; i < strs.length; i++) {
                if (substrRegex.test(strs[i])) {
                    matches.push(strs[i]);
                }
            }

            cb(matches);
        };
    };

    var states = ["Allahabad Bank", "Andhra Bank", "Axis Bank", "Bank of Bahrain and Kuwait", "Bank of Baroda - Corporate Banking", "Bank of Baroda - Retail Banking", "Bank of India", "Bank of Maharashtra", "Canara Bank", "Central Bank of India", "City Union Bank", "Corporation Bank", "Deutsche Bank", "Development Credit Bank", "Dhanlaxmi Bank", "Federal Bank", "ICICI Bank", "IDBI Bank", "Indian Bank", "Indian Overseas Bank", "IndusInd Bank", "ING Vysya Bank", "Jammu and Kashmir Bank", "Karnataka Bank Ltd", "Karur Vysya Bank", "Kotak Bank", "Laxmi Vilas Bank", "Oriental Bank of Commerce", "Punjab National Bank - Corporate Banking", "Punjab National Bank - Retail Banking", "Punjab & Sind Bank", "Shamrao Vitthal Co-operative Bank", "South Indian Bank", "State Bank of Bikaner & Jaipur", "State Bank of Hyderabad", "State Bank of India", "State Bank of Mysore", "State Bank of Patiala", "State Bank of Travancore", "Syndicate Bank", "Tamilnad Mercantile Bank Ltd.", "UCO Bank", "Union Bank of India", "United Bank of India", "Vijaya Bank", "Yes Bank Ltd"];


    $('#the-basics .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'states',
        source: substringMatcher(states)
    });
    // constructs the suggestion engine
    var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: states
    });

    $('#bloodhound .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'states',
        source: states
    });
});