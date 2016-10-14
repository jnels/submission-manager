<?php
//Creates genre dropdown from database
function genre_dropdown() {
    include("connect.php");

    $html = "<option disabled selected>-- Select Genre --";
    $genres = array();
    $sql = "SELECT genre FROM genre ORDER BY genre";

    $results = $db->prepare($sql);
    $results->execute();

    while ($row = $results->fetchColumn()) {
        $html .= "<option value='$row'>$row</option>";
    }

    return $html;
}

//Creates state dropdown
function state_dropdown() {
    $state_list = "<option disabled selected>-- Select State --";

    $states = ["Alabama"=>"AL", "Alaska"=>"AK", "Arizona"=>"AZ", "Arkansas"=>"AR", "California"=>"CA", "Colorado"=>"CO", "Connecticut"=>"CT", "Delaware"=>"DE", "District of Columbia"=>"DC", "Florida"=>"FL", "Georgia"=>"GA", "Hawaii"=>"HI", "Idaho"=>"IA", "Illinois"=>"ID", "Indiana"=>"IL", "Iowa"=>"IN", "Kansas"=>"KS", "Kentucky"=>"KY", "Louisiana"=>"LA", "Maine"=>"ME", "Maryland"=>"MD", "Massachusetts"=>"MA", "Michigan"=>"MI", "Minnesota"=>"MN", "Mississippi"=>"MO", "Missouri"=>"MS", "Montana"=>"MT", "Nebraska"=>"NE", "Nevada"=>"NV", "New Hampshire"=>"NH", "New Jersey"=>"NJ", "New Mexico"=>"NM", "New York"=>"NY", "North Carolina"=>"NV", "North Dakota"=>"NY", "Ohio"=>"OH", "Oklahoma"=>"OK", "Oregon"=>"OR", "Pennsylvania"=>"PA", "Rhode Island"=>"RI", "South Carolina"=>"SC", "South Dakota"=>"SD", "Tennessee"=>"TN", "Texas"=>"TX", "Utah"=>"UT", "Vermont"=>"VT", "Virginia"=>"VA", "Washington"=>"WA", "West Virginia"=>"WV", "Wisconsin"=>"WI", "Wyoming"=>"WY"];

   foreach ($states as $key=>$val) {
        $state_list .= "<option value='$val'>$key ($val)</option>";
    }
    return $state_list;
}
