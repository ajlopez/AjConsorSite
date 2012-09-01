<?
function DateToString($date)
{
    return date('Y-m-d', strtotime($date));
}

function DateToday()
{
    return date('Y-m-d');
}

function DateToISOYearNumber($date)
{
    return date('o', strtotime($date));
}

function DateToISOWeekNumber($date)
{
    return date('W', strtotime($date));
}

function DateToWeekDayName($date)
{
    return date('l', strtotime($date));
}

function DateToMonday($date)
{
    $dayname = DateToWeekDayName($date);
    
    if ($dayname == 'Monday')
        return $date;
            
    return date('Y-m-d', strtotime('last Monday', strtotime($date)));
}

function DateAddDays($date, $days)
{
    return date('Y-m-d', strtotime($days . ' days', strtotime($date)));
}
?>