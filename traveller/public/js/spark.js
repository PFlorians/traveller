/*
*   Onready launch
*/
var calendar;
var cal; //this is global, this src file needs to be included before anything else
$(document).ready(
      function ()
      {
        calendar=$("#calendar").calendar(
          {
            tmpl_path: "bower_components/bootstrap-calendar/tmpls/",
            events_source: function () {return [//tot sa musi natiahnut zo servera
              {
                  "id": 1,
                  "title": "Cesta do Heidelbergu",
                  "url": "#",
                  "class": "event-important",
                  "start": moment().valueOf(), // Now in milliseconds
                  "end": moment().add(2, 'days').valueOf() // Now + 2 days in milliseconds
              },
              {
                  "id": 2,
                  "title": "Cesta do prahy",
                  "url": "#",
                  "class": "event-default",
                  "start": moment().add(1, 'days').valueOf(), // Now + 1 day in milliseconds
                  "end": moment().add(3, 'days').valueOf() // Now + 3 days in milliseconds
              },

            ];},
            view: 'week',
            first_day: 1,
            onAfterViewLoad: function(view)
            {
              $("#kde").text(this.getTitle());
              $("btn-group[data-calendar-view='"+view+"']").addClass("active");//nech aktivne podla rozlozenia
              //$("btn-group button").removeClass('active');
            }
          });
          $('.btn-group button[data-calendar-nav]').each(function() {
        		var $this = $(this);
        		$this.click(function() {
        			calendar.navigate($this.data('calendar-nav'));
        		});
        	});
          $('.btn-group button[data-calendar-view]').each(function(){
            var $this=$(this);
            $this.click(function() {
              calendar.view($this.data('calendar-view'));
            });
          });
      }
);
