<?php
    
    function getEvent( $date)
    {
        include('connect.php');
        $sql = "SELECT * FROM events WHERE date='$date' ORDER BY time";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
           return $result;
        } 
        
    }
   
    /* draws a calendar */
    function draw_calendar($month,$year,$flag){

        /* draw table */
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $headings = array('Sun','Mon','Tue','W','Thu','Fri','Sat');
        $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        $current_day=date("d");
        $current_month = date("m");
        
        /* row for week one */
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
                $date= date("Y-m-d",mktime(0,0,0,$month,$list_day,$year));
                if ($current_month >= $month && !($current_day == $list_day && $current_month == $month) && $flag == 1)
                { 
                    if(getEvent($date))
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="day-number event" >'.$list_day.'</div></a>';
                    }
                    else
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="day-number">'.$list_day.'</div></a>';
                    }
                }
                else if($current_day == $list_day && $current_month == $month )
                {
                    if(getEvent($date))
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="current-day-number event" >'.$list_day.'</div></a>';
                        $flag=0;
                    }
                    else
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="current-day-number">'.$list_day.'</div></a>';
                        $flag=0;
                    }
                }
                else
                {
                    if(getEvent($date))
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="upcoming-day-number event" >'.$list_day.'</div></a>';
                    }
                    else
                    {
                        $calendar.= '<td class="calendar-day">';
                        $calendar.= '<a href="events.php?date='.$date.'"><div class="upcoming-day-number">'.$list_day.'</div></a>';
                    }
                }
            $calendar.= '</td>';
            if($running_day == 6):
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar.= '</tr>';

        /* end the table */
        $calendar.= '</table>';
        
        /* all done, return result */
        return $calendar;
    }

    
    //mysqli_close($con);

?>