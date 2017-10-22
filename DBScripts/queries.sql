use `mydb`;

--addEvent
insert into event (event.Name)
  values ('$_POST[Name]');

--addEvent_User always with "addEvent" $idEvent = mysqli_insert_id()
insert into event_user
  values ('$idEvent', '$_SESSION[idUser]');

--addGroup
insert into `mydb`.group (idEvent, Name)
  values ('$_GET[idEvent]', '$_POST[Name]');

--addReservation
insert into reservation (idEvent, idGroup, Name, Comment, Quantity)
  values ('$_GET[idEvent]', '$_GET[idGroup]', '$_POST[Name]', '$_POST[Comment]', '$_POST[Quantity]');

--addSeat
insert into seat (Row, Seat, idEvent)
  values ('$_GET[Row]', '$_GET[Seat]', '$_GET[idEvent]');

--addAisle
insert into aisle (idEvent, Row, Left_Seat, Width)
  values ('$_GET[idEvent]', '$_GET[Row]', '$_GET[Left_Seat]', '$_GET[Width]');

--updates
--заполнение брони
update seat
  set idReservation = '$_POST[idReservation]'
  where seat.idEvent = '$_POST[idEvent]'
  and seat.Row = '$_POST[Row]'
  and seat.Seat = '$_POST[Seat]';

--сброс брони
update seat
  set idReservation = NULL
  where seat.idEvent = '$_POST[idEvent]'
  and seat.Row = '$_POST[Row]'
  and seat.Seat = '$_POST[Seat]';

--updateReservation
update reservation
  set idEvent = '$_POST[idEvent]', idGroup = '$_POST[idGroup]', Name = '$_POST[Name]', Comment = '$_POST[Comment]', Quantity = '$_POST[Quantity]'
  where idReservation = '$_GET[idReservation]';

--delete Group
delete from `mydb`.group
  where idGroup = '$_POST[idGroup]' and idEvent = '$_POST[idEvent]';

--updateGroup
update `mydb`.group
  set Name = '$_POST[Name]'
  where idGroup = '$_POST[idGroup]' and idEvent = '$_POST[idEvent]';

--delete User
delete from event_user
  where idUser = '$_GET[idUser]'
  and idEvent = '$_GET[idEvent]';

--getEventsByUserId (return idEvent and Name?)
select e.*
  from event e, event_user eu, user u
  where e.idEvent = eu.idEvent
    and eu.idUser = u.idUser
    and u.idUser = '$_GET[idUser]';

--getUsersByEventId (DONT SHOW PASSWORD!!!.....................or show it?)
select u.*
  from event e, event_user eu, user u
  where e.idEvent = eu.idEvent
    and eu.idUser = u.idUser
    and e.idEvent = '$_GET[idEvent]';

--getSeatsByEventId
select s.*
  from seat s, event e
  where s.idEvent = '$_GET[idEvent]';

--getGroupByEventId
select g.*
  from `mydb`.group g, event e
  where g.idEvent = '$_GET[idEvent]';

--deleteEvent
delete from event
  where event.id = '$_GET[idEvent]';

--updateEvent
update event
  set Name = '$_POST[Name]'
  where idEvent = '$_GET[idEvent]';
