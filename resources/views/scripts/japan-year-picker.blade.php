<!-- Input field to display the selected year -->
<!-- <input type="text" id="yearPicker" readonly> -->

<!-- Include the necessary jQuery UI and jQuery libraries -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    // Define the Japanese era years
    var eraYears = {
        "令和": { start: 2019, end: 9999 },
        "平成": { start: 1989, end: 2019 },
        "昭和": { start: 1926, end: 1989 },
        "大正": { start: 1912, end: 1926 },
        "明治": { start: 1868, end: 1912 }
    };
    
    // Initialize the datepicker
    $("#yearPicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "1868:9999",
        beforeShowYear: function(date) {
        var year = date.getFullYear();
        var era = getJapaneseEra(year);
        if (era) {
            return era + " " + getEraYear(year, era);
        }
        return "";
        }
    });
    
    // Function to get the Japanese era based on the year
    function getJapaneseEra(year) {
        for (var era in eraYears) {
        if (year >= eraYears[era].start && year <= eraYears[era].end) {
            return era;
        }
        }
        return "";
    }
    
    // Function to get the era year based on the year and era
    function getEraYear(year, era) {
        var eraYear = year - eraYears[era].start + 1;
        return eraYear.toString();
    }
});

</script>