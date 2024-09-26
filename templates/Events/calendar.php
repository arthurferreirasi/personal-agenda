<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8' />
  <?= $this->Html->css('modal') ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'timeGridDay,timeGridWeek,dayGridMonth,multiMonthYear'
        },
        buttonText: {
          today: 'Hoje',
          month: 'Mês',
          week: 'Semana',
          day: 'Dia',
          year: 'Ano',
          list: 'Lista'
        },
        events: '/events/fetch',
        navLinks: true,
        selectMirror: true,
        selectable: true,
        select: function (arg) {
          openAddModal(arg.title, arg.start, arg.end);
          calendar.unselect()
        },
        eventClick: function (info) {
          openEditModal(info.event.id);
        },
        editable: true,
        locale: 'pt-br',

      });
      calendar.render();
    });

    function openAddModal(title, startDate, endDate) {
      var modal = document.getElementById("eventModal");
      var closeBtn = document.getElementsByClassName("close")[0];

      modal.style.display = "block";

      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/events/add?title=" + title + ",&start=" + startDate + "&end=" + endDate, true);
      xhr.onload = function () {
        if (xhr.status == 200) {
          document.getElementById("modalBody").innerHTML = xhr.responseText;
        }
      };
      xhr.send();

      closeBtn.onclick = function () {
        modal.style.display = "none";
      };

      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };
    }

    function openEditModal(eventId) {
      var modal = document.getElementById("eventModal");
        var closeBtn = document.getElementsByClassName("close")[0];

        modal.style.display = "block";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/events/edit/" + eventId, true);
        xhr.onload = function () {
          if (xhr.status == 200) {
            document.getElementById("modalBody").innerHTML = xhr.responseText;
          }
        };
        xhr.send();

        closeBtn.onclick = function () {
          modal.style.display = "none";
        };

        window.onclick = function (event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        };
    }
  
    function showNotification(title, body) {
    if (Notification.permission === "granted") {
        new Notification(title, { body: body });
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                new Notification(title, { body: body });
            }
        });
    }
}

  
  </script>

</head>

<body>

  <div id='calendar'></div>

  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="modalBody">

      </div>
    </div>
  </div>
</body>

</html>