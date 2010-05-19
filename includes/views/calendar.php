

<div style="float:right; ; margin-top: 24px; width: 295px">Remember to check the <strong>Diary dates</strong> (below) for date, time and venue changes</div>

<h2 style="float:left">Scheduled classes</h2>


<table class="scheduled">
    
     <tr>
        <td rowspan="4" class="town">
            <strong>London</strong>
        </td>
        <td rowspan="2" class="day" >
            Monday
        </td>
        <td class="time">
            6:30-7:30pm<br />
            <a href="/karate-london/karate-barnes">Kitson Hall, Barnes</a>
        </td>
        <td>
            <strong>Karate for Kids <span style="display: inline; color: red">NEW!</span></strong> </td>
    </tr>    
    
    
    
    <tr>
       
       
        <td class="time">
            8:00-9:00pm<br />
            <a href="/karate-london/karate-barnes">Kitson Hall, Barnes</a>
        </td>
        <td>
            <strong>Karate for Adults</strong> - and younger by invitation
            <span>Second Monday of the month: blue and above only</span>
        </td>
    </tr>    
    
    <tr>
        
        <td class="day">
            Thursday
        </td>
        <td class="time">
            8:00-9:30pm<br />
            <a href="/karate-london/karate-barnes">Kitson Hall, Barnes</a>
        </td>
        <td>
             <strong>Karate for Adults</strong> - and younger by invitation
        </td>
    </tr>    

    <tr>
        
        <td class="day">
            Saturday
        </td>
        <td class="time">
            9:30-10:30am<br />
            <a href="/karate-london/st-etheldreda">St Ethel's, Fulham</a>
        </td>
        <td>
             <strong>Karate for All Ages</strong>
             <span>Blue and above finish at 11:00am</span>
        </td>
    </tr>    

    <tr>
        <td rowspan="2" class="town">
            <strong>Surrey</strong>
        </td>
        <td class="day">
            Tuesday
        </td>
        <td class="time">
            5:00-5:45pm<br />
            <a href="/karate-surrey/getting-to-rodborough-stc">Rodborough College</a>
        </td>
        <td>
             <strong>Karate for Kids</strong>
        </td>
    </tr>    
    
    <tr>
        
        <td class="day">
            Wednesday
        </td>
        <td class="time">
            7:45-9:15pm<br />
            <a href="/karate-surrey/getting-to-rodborough-stc" >Rodborough College</a>
        </td>
        <td>
             <strong>Karate for Adults</strong> - and younger by invitation
        </td>
    </tr>
    
</table>


<div style="float:right; ; margin-top: 24px; width: 295px; text-align: right">
 <a href="/calendar.xml"><img src="images/feed.gif" width="16" height="16" alt="Subscribe"></a> <a href="/calendar.xml">Subscribe to our RSS feed</a>
</div>

<h2>Diary dates</h2>
    
    
    <?php if(empty($eventArray)): ?>
    
        <p>No diary dates at present</p>
        
    <?php else: ?>


       <?php require 'calendar-event-table.php' ?>
        
    <?php endif ?>
