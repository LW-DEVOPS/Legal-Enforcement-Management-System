show databases;

create database titodb;
use titodb;


-- Table structure for table users
CREATE TABLE public (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname varchar(100) NOT NULL,
  lastname varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(100) NOT NULL,
  town varchar(100) NOT NULL,
  postaladdress varchar(100) NOT NULL,
  dob varchar(100) NOT NULL,
  idnumber varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  security_question varchar(100) NOT NULL,
  security_answer varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table admin
CREATE TABLE admin (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(100) NOT NULL,
  password varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (username, password) VALUES ('admin', 'admin');
INSERT INTO admin (username, password) VALUES ('laban', 'laban123');


-- Table structure for table police
CREATE TABLE police (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fullname varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  phone varchar(100) NOT NULL,
  workid varchar(100) NOT NULL,
  station varchar(100) NOT NULL,
  gender varchar(10) NOT NULL,
  postaladdress varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  security_question varchar(100) NOT NULL,
  security_answer varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table police_station
CREATE TABLE police_station (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(100) NOT NULL,
  code varchar(100) NOT NULL,
  county varchar(100) NOT NULL,
  location varchar(100) NOT NULL,
  phone varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table cases
CREATE TABLE cases (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  userid int(100) NOT NULL,
  obnumber varchar(100) NOT NULL,
  title varchar(100) NOT NULL,
  statement varchar(100) NOT NULL,
  date varchar(100) NOT NULL,
  status varchar(100) NOT NULL,
  FOREIGN KEY (userid) REFERENCES public (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for messages
CREATE TABLE message (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  number varchar(100) NOT NULL,
  message varchar(100) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES public (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table case_assignments
CREATE TABLE case_assignments (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  caseid int(100) NOT NULL,
  policeid int(100) NOT NULL,
  date varchar(100) NOT NULL,
  status varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

show tables;

INSERT INTO `police` (`id`, `fullname`, `email`, `phone`, `workid`, `station`, `gender`, `postaladdress`, `password`, `security_question`, `security_answer`) VALUES
(1, 'Laban Waititu', 'labanwanja@gmail.com', '0710110709', '37278660', 'Buruburu Police Station', 'male', '214666', '$2y$10$A6iZWtCELyCZZTxQbPhbuu.iPYoe6mav/7pvlzeQf3xZ1XSRR83ce', 'What is your mother\'s maiden name?', 'Irene'),
(2, 'Cyprian Esogol', 'cyprian@gmail.com', '0723061593', '91581904', 'Buruburu Police Station', 'male', '23692', '$2y$10$5Ayebk0vcUkLxzTVD7iU0Ohze8P/PQCd.RbCJP3ysRNs943WFHqIe', 'What is your favorite color?', 'Red'),
(3, 'Elsie Kisabit', 'elsie@gmail.com', '0724751865', '65189742', 'Igonji Police Station', 'male', '246733', '$2y$10$vxBHGnMQpJO1qqkiHcUfruJ8fxdMzn0slcgKalX.YP.PwlUBS4GGW', 'What is your favorite food?', 'Pilau'),
(4, 'Dan Stan', 'dan@gmail.com', '0765134987', '78563851', 'Jogoo Police Station ', 'male', '45890', '$2y$10$4uZ8PwRNX2Pf7OXUhBQkk.VxRng.U5maKw7Db7OxrUM6yhqGo.BDK', 'What is your favorite sport?', 'Football'),
(5, 'Raphael Kariuki', 'raphael@gmail.com', '0756147826', '78428673', 'Jogoo Police Station ', 'male', '26722', '$2y$10$U1G0pK2Bvrt/.8hdTnRejet00srMuZwXL0rD8WHOxu1ZMMSGLTicO', 'What is your favorite sport?', 'Rugby'),
(6, 'John Kinyua', 'johnn@yahoo.com', '0722270736', '12569380', 'Gilgil Police Station', 'male', '23567', '$2y$10$KAAL6lTIIHncCl6aAMUf4eXpfCdLch1TLuzqHZuxwSvUTFc9XhDf6', 'What is your mother\'s maiden name?', 'Mercy'),
(7, 'George Wephukulu', 'george@gmail.com', '0745538978', '64542378', 'Butere Police Station', 'male', '23534', '$2y$10$bUw3LygxY.CsCk2F0OnMZOqsBIqay0yHWwEiUZg2zXG35LxAqFtUa', 'What is your favorite movie?', 'Transformer'),
(8, 'Elizabeth Onyango', 'elizabeth@gmail.com', '0789169365', '14679284', 'Eldoret Police Station', 'female', '23479', '$2y$10$T.uSHK6jsqayGEBFn9jqE.4tn3hzGkhEO1coHon3UydlY1Ww4ji9q', 'What is your favorite book?', 'Blackbook'),
(9, 'Sharon Muthoni Muthike', 'sharon@gmail.com', '0739628267', '98230826', 'Funyula Police Station', 'female', '23892', '$2y$10$i9vKWbNb619vpqywCdFOe.A/k5Hi3F6kLc0q/YvrYPl2AOe2ZYse.', 'What is your favorite food?', 'Chapati'),
(10, 'Chepsiror Andrew Kipkoech', 'andrew@icloud.com', '0739176095', '98268329', 'Gilgil Police Station', 'male', '23434', '$2y$10$dl7I1bF9mccaV3/ZHJXnHOJyMsXxNm5XSiM3W0hATzgkMd9zsSEoq', 'What is your favorite movie?', 'Breakpoint'),
(11, 'Eva Mosero Nyabwengi', 'eva@gmail.com', '0771173987', '21765982', 'Homabay OCPD Office', 'female', '23594', '$2y$10$xTcNEGnQxjOdQ9jEQEiflOTQkNFstlVvMC7bZT7URVeQY/zUWAS0G', 'In what year was your mother born?', '1976'),
(12, 'Kelvin Murimi Githinji', 'kevin@icloud.com', '0110175228', '21653782', 'Jogoo Police Station', 'male', '23923', '$2y$10$kT2.x4Z63WT0HEce2pYdGOZ7FckSPlVU21TnStTpUI4BjPChyknzS', 'What was your dream job as a child?', 'Pilot'),
(13, 'Malvin Kiprop Kiplangat', 'malvin@gmail.com', '0798364298', '89346267', 'Bahati Police Station', 'male', '23564', '$2y$10$6Pg4FB6wNNiPZWNRCXxSsumL/rnXnWnVsgbShoe1FcQrvC7SElL/2', 'What is your current car registration number?', 'KCX123K'),
(14, 'Faith Orina', 'faith@gmail.com', '0710276298', '76295634', 'Bura Police Station', 'female', '23356', '$2y$10$Zv0E1/mL/YAwXr3JkQa73.jMkkm/WtEmPpYx7TjOrdK/oTpsoGXV.', 'What time of the day were you born?', '11pm'),
(15, 'Wema Muthoni', 'wema@gmail.com', '0729254287', '98257241', 'Githunguri Police Station', 'female', '23479', '$2y$10$h2yvAAGWU4a9PNTPC.2rzukXOeb3U9ng.mUHOF1sbH802LKIhnxGW', 'In what year was your mother born?', '1978'),
(16, 'Mark Kimanzi', 'mark@gmail.com', '0789245298', '23718467', 'Kabati Police Station', 'male', '3563', '$2y$10$pZnj/FXcsJrz0Fq/9Lsp3ORiW9jebez8/X.TctXx4nMho18hdhLIy', 'What are the last 5 digits of your credit card?', '12567');


INSERT INTO `police_station` (`id`, `name`, `code`, `county`, `location`, `phone`) VALUES
(1, 'Igonji Police Station', 'KA7cG', 'Meru', 'Igonji', '056767620222'),
(2, 'Buruburu Police Station', 'ZC8jU', 'Nairobi', 'Embakasi', '056620222'),
(4, 'Butere Police Station', 'fFO6y', 'Kakamega', 'Butere', '056620004'),
(5, 'Eldoret Police Station', 'YKPXJ', 'Eldoret', 'Eldoret', '0532032900'),
(6, 'Funyula Police Station ', 'uAyWh', 'Siaya', 'Funyula', '05563209'),
(7, 'Gilgil Police Station ', '10rK3', 'Nairobi', 'Kaunda', '0504228'),
(8, ' Homabay OCPD Office', 'eJG6s', 'Homabay', 'Homabay', '05922258'),
(9, 'Jogoo Police Station ', 'h3Pyi', 'Nairobi', 'Makadara', '06752176'),
(10, 'Bahati Police Station ', 'T8g7d', 'Nairobi', 'Bahati', '05152299'),
(11, 'Bura Police Station ', 'u6DxL', 'Marsabit', 'Garbatulla', '04662229'),
(12, 'Githunguri Police Station', 'JYaCm', 'Kiambu', 'Githunguri', '06665009'),
(13, 'Kabati Police Station', 'IB2pl', 'Muranga', 'Kabati', '06072223'),
(14, 'Keroka Police Station ', '5V1aU', 'Nyamira', 'Keroka', '058520064'),
(15, 'Kigumo Police Station ', 'RwOp8', 'Kiambu', 'Kigumo', '06044409'),
(16, 'Kitui OCPD Office', 'Ns2MC', 'Kitui', 'Kitui', '04422055'),
(17, 'Lolgorian Police Station', 'QkjwF', 'Narok', 'Lolgorian', '05123237'),
(18, 'Matunda Police Station', 'jAgiN', 'Kakamega', 'Matunda', '05372172'),
(19, 'Nairobi Industrial Area ', 'pXgdL', 'Nairobi', 'Muthurwa', '020557284'),
(20, 'Saba Saba Police Post ', 'cGor5', 'Nairobi', 'Sabasaba', '06042463'),
(21, 'Wundanyi Police Station ', 'ZuY6s', 'Mombasa', 'Wundanyi', '04342002');

INSERT INTO `public` (`id`, `firstname`, `lastname`, `email`, `phone`, `town`, `postaladdress`, `dob`, `idnumber`, `password`, `security_question`, `security_answer`) VALUES
(1, 'Irene', 'Wanja', 'irene@gmail.com', '0721523602', 'Nakuru', '257627', '09/08/1996', '21754387', '$2y$10$IqhC1.KLtg9Tl6cifQYOjO5X5pUAcL0mOLsXl4uSEQtcnYXEgkJxS', 'What is your favorite book?', 'Rebecca'),
(2, 'Gorretti', 'Ngaru', 'gorretti@gmail.com', '0721576824', 'Embakasi', '21588', '09/03/1971', '21457697', '$2y$10$/ljro7GrEJixLATNrSYj6e3bQAWeXdj/.gVUbf.dm/uNMooFCkA12', 'What is your favorite book?', 'Joseph'),
(3, 'Martin', 'Ngaru', 'martin@gmail.com', '0739465987', 'Naivasha', '45987', '04/12/1991', '34567934', '$2y$10$Axysrp0yiyHToVm2pJndO..lqYJlAV2OIHQ.C0Im7Av28dxtVxzze', 'What is your mother\'s maiden name?', 'Agnes'),
(4, 'Mercy', 'Wangechi', 'mecy@gmail.com', '0771173853', 'Nairobi', '54789', '23/11/1990', '23876543', '$2y$10$sSwqEYh2NiuFBm4mqBI//.XkH4asTuXvmlvn.T3HSfqBVV5PFbz/6', 'What is your mother\'s maiden name?', 'Irene'),
(5, 'John', 'Kamau', 'john@gmail.com', '0722908734', 'Busia', '21963', '16/02/1987', '12694597', '$2y$10$lXr/PE5GWPmTnton95a2Ne4.O4nHvFFe0ThxBbt.L6fCnFtNlGEQG', 'What is your favorite color?', 'Blue'),
(6, 'Angela', 'Wanza', 'angela@gmail.com', '0712846026', 'Mombasa', '27986', '31/01/1987', '22698354', '$2y$10$SNMgo0rFyVgb5Opy3j1dcuIxg9YQW3ljXKlCZ1aeOYgjx3reiW7iG', 'What is your favorite color?', 'Yellow'),
(7, 'Collins', 'Njau', 'collins@gmail.com', '0726816862', 'Moyale', '21987', '28/03/1997', '31498528', '$2y$10$2w3TUloHmqdw34JmK0QL7um6mAhjQO07MoRJYR1qJQ9Vm7Vmx8SKe', 'What is your favorite sport?', 'Javelin'),
(8, 'Abigail', 'Wairimu', 'abigail@gmail.com', '0736982642', 'Kiambu', '35612', '29/01/2000', '38765432', '$2y$10$1nlY8Y2ezkmOeZL79lqWaeROLp/fH4frIoCDNxOy3Wa117Mj7/s5S', 'What is your mother\'s maiden name?', 'Wanja'),
(9, 'Sharon', 'Chepkemoi', 'sharon@gmail.com', '0789323872', 'Narok', '7347', '21/07/1987', '21459838', '$2y$10$uDvBfdvQZrYnGnvi1/uXWeALpx/D//9ce6K4hRF.8UvAqp89U6152', 'What is your favorite sport?', 'Jaolin'),
(10, 'Kiprop', 'Emmanuel', 'kiprop@gmail.com', '0735982458', 'Marsabit', '7467', '23/08/1967', '12893692', '$2y$10$g4fIk0gof5wtNWZ6MWTNEe6./uVDSYJosKTzKzktyUU8fy6gaAgYm', 'What is your favorite color?', 'Purple'),
(11, 'Samuel', 'Gitimu', 'samuel@gmail.com', '0712653987', 'Buruburu', '234276', '12/12/1988', '36729825', '$2y$10$8mpPgUPVr9jgYwnismmIguf44KgU/PdImI4bsDWTc493Jn5g4po7q', 'What is your mother\'s maiden name?', 'Sharon');


INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'Irene', 'irene@gmail.com', '0721523602', 'The system is a bit slow.'),
(2, 2, 'Gorretti', 'gorretti@gmail.com', '0771173853', 'I was pleased with the system.'),
(3, 3, 'Martin', 'martin@gmail.com', '0710110709', 'Cant seem to change my password.'),
(4, 5, 'John', 'john@gmail.com', '0722908734', 'Thank you.'),
(5, 4, 'Mercy', 'mercy@gmail.com', '0771173853', 'The sytem was very much helpfull.');


INSERT INTO `cases` (`id`, `userid`, `obnumber`, `title`, `statement`, `date`, `status`) VALUES
(1, 1, 'OB/ek5O24aCl6', 'Mugged', 'I was robbed yesterday night along Manyanja Road.', '2022-07-08 14:37:40', 'opened'),
(2, 2, 'OB/VtuOqEvWry', 'Rapped', 'I was rapped in Kayole', '2022-07-08 14:43:49', 'opened'),
(3, 3, 'OB/YenW3dgvzl', 'Robbery', 'I was attacked by four gunmen armed to the teeth and my wallet was robbed.', '2022-07-08 14:56:12', 'opened'),
(4, 5, 'OB/e6MpWUjQiG', 'Name defarmation', 'My name has been used wrongfully on social media handles.', '2022-07-08 15:02:55', 'pending'),
(5, 4, 'OB/HozX4cw7mC', 'Mugged', 'I was mugged as I was going home along Kenyatta Avenue at 8;30 PM.', '2022-07-08 15:05:09', 'pending'),
(6, 6, 'OB/aVNfMZjngB', 'Rape', 'I was rapped last week', '2022-07-08 15:23:27', 'pending'),
(7, 11, 'OB/Rj2hg5w1VZ', 'Domestic Case', 'I was beaten by Husband yesterday.\r\n', '2022-07-12 09:08:12', 'pending'),
(8, 10, 'OB/HZNLxhT06z', 'Defilement', 'I was defiled by my Father.', '2022-07-12 09:10:47', 'pending'),
(9, 9, 'OB/AayCQF3Ucm', 'Fraud', 'My supermarket was broken and items were stolen.', '2022-07-12 09:12:05', 'pending'),
(10, 8, 'OB/9XrNQxSt57', 'Theft Case', 'My house was broken into by armed robbers and money was stolen.', '2022-07-12 09:13:57', 'pending'),
(11, 7, 'OB/GnPfroLNkl', 'Robbing', 'I was robbed in Kayole.', '2022-07-12 09:15:17', 'pending');


INSERT INTO `case_assignments` (`id`, `caseid`, `policeid`, `date`, `status`) VALUES
(1, 1, 2, '2022-07-08', 'active'),
(2, 2, 4, '2022-07-08', 'active'),
(3, 3, 2, '2022-07-08', 'active');

drop view public_view;
CREATE VIEW public_view AS SELECT public.idnumber, public.firstname, public.lastname, public.dob, cases.obnumber, cases.title, cases.statement, cases.date, cases.status, police.workid, police.fullname, case_assignments.id FROM public INNER JOIN cases ON public.id = cases.userid INNER JOIN case_assignments ON cases.id = case_assignments.caseid INNER JOIN police ON case_assignments.policeid = police.id;
select * from public_view;

drop table case_investigations;

CREATE TABLE case_investigations (
  id int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  caseid int(100) NOT NULL,
  policeworkid int(100) NOT NULL,
  obnumber varchar(100) NOT NULL,
  investigation varchar(100) NOT NULL,
  status varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

drop view public_view_statement;
CREATE VIEW public_view_statement AS SELECT public.idnumber, public.firstname, public.lastname, cases.obnumber, cases.title, cases.statement, cases.date, police.workid, police.fullname, case_investigations.id, case_investigations.status, case_investigations.investigation FROM public INNER JOIN cases ON public.id = cases.userid INNER JOIN case_investigations ON cases.id = case_investigations.caseid INNER JOIN police ON case_investigations.policeworkid = police.workid;
select * from public_view_statement;

CREATE VIEW public_view_assigned AS SELECT public.idnumber, public.firstname, public.lastname, cases.obnumber, cases.title, cases.statement, police.workid, police.fullname, case_assignments.id, case_assignments.status, case_assignments.date FROM public INNER JOIN cases ON public.id = cases.userid INNER JOIN case_assignments ON cases.id = case_assignments.caseid INNER JOIN police ON case_assignments.policeid = police.id;
select * from public_view_assigned;

CREATE VIEW public_view_unassigned AS SELECT public.idnumber, public.firstname, public.lastname, cases.obnumber, cases.title, cases.statement, police.workid, police.fullname, case_assignments.id, case_assignments.status, case_assignments.date FROM public INNER JOIN cases ON public.id = cases.userid LEFT JOIN case_assignments ON cases.id = case_assignments.caseid LEFT JOIN police ON case_assignments.policeid = police.id WHERE case_assignments.id IS NULL;
select * from public_view_unassigned;

CREATE VIEW public_view_ongoing AS SELECT public.idnumber, public.firstname, public.lastname, cases.obnumber, cases.title, cases.statement, police.workid, police.fullname, case_investigations.id, case_investigations.status, case_investigations.investigation FROM public INNER JOIN cases ON public.id = cases.userid INNER JOIN case_investigations ON cases.id = case_investigations.caseid INNER JOIN police ON case_investigations.policeworkid = police.workid WHERE case_investigations.status = 'ongoing';
select * from public_view_ongoing;

drop view public_view_completed;
CREATE VIEW public_view_completed AS SELECT public.idnumber, public.firstname, public.lastname, cases.obnumber, cases.title, cases.statement, police.workid, police.fullname, case_investigations.id, case_investigations.status, case_investigations.investigation FROM public INNER JOIN cases ON public.id = cases.userid INNER JOIN case_investigations ON cases.id = case_investigations.caseid INNER JOIN police ON case_investigations.policeworkid = police.workid WHERE case_investigations.status = 'Completed';
select * from public_view_completed;