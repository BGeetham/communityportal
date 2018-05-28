

CREATE DEFINER=`root`@`localhost` PROCEDURE `procSaveUser`(i_id int,i_firstname varchar(45),i_lastname varchar(45),i_email varchar(45),
i_password varchar(20),i_country varchar(45),i_city varchar(45),i_education varchar(45),i_company varchar(45))

BEGIN

 if(i_id=0) then

 insert into tb_user(firstName,lastName,email,password,country,city,education,company) 
values(i_firstname,i_lastname,i_email,i_password,i_country,i_city,i_education,i_company);

 Else

 update tb_user set
 firstName=i_firstname,
lastName=i_lastname,
email=i_email,
password=i_password
country=i_country,
city=i_city,
education=i_education,
company=company where id=i_id;

 end if;
END$$

