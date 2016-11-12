function daysInMonth(month, year) {
  return new Date(year, month, 0).getDate();
}

var monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednsday', 'Thursday', 'Friday', 'Saturday'];

var d = new Date();
var m = d.getMonth();
var day = d.getDay();

var _d = new Date(d.getFullYear() + '-' + d.getMonth() + '01');
console.log('First day of month: ' + weekDays[1]);

var monthName = monthArr[m];
console.log('Today is: ' + weekDays[d.getDay()]);

$(function(){
  $('.calendar-table thead tr td').html('<h1>' + monthName + '</h1>');

  var cal = '';
  var num = 1;

  for (var i = 0; i < 5; i++)
  {
    cal = cal + '<tr>';
    for (var j = 0; j < 7; j++)
    {
      if(num == d.getDate())
        cal = cal + '<td class="day-td today"><span class="cal-day">' + num + '</span></td>';
      else
        cal = cal + '<td class="day-td"><span class="cal-day">' + num + '</span></td>';
      num++;
    }
    cal = cal + '</tr>';
  }

  $('.calendar-table tbody').append(cal);

  $('.side-calendar > h1').html(d.getDate());
  $('.side-calendar > h3').html(weekDays[d.getDay()]);
});
