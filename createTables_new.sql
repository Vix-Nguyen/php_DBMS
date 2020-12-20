use hospital;

CREATE TABLE DEPARTMENT (
	Id			int					NOT NULL AUTO_INCREMENT,
    Title		varchar(255)		NOT NULL,
    DeanId		int,
    PRIMARY KEY (Id)
);

-- insert departments 
INSERT INTO Department(Title, DeanId)
VALUES 	('General Medicine', 1),
		('Surgery', 2),
        ('Psychiatry', 3),
        ('Imaging', 4),
        ('Mother Child', 5)
;

CREATE TABLE EMPLOYEE (
	Id			int				 NOT NULL AUTO_INCREMENT,
    Fname		varchar(255)					NOT NULL,
    Lname		varchar(255)					NOT NULL,
    DOB			date							NOT NULL,
    Address		varchar(255)					NOT NULL,
	StartDate	date							NOT NULL,
    Gender		set('Male', 'Female', 'Other')	NOT NULL,
    Speciality	varchar(255)					NOT NULL,
    DepartmentId 	int							NOT NULL,
    CONSTRAINT PK_Employee PRIMARY KEY (Id)
);

-- insert employees
INSERT INTO Employee(Fname, Lname, DOB, Address, StartDate, Gender, Speciality, DepartmentId)
VALUES 	('Nguyen', 'A', '1990-01-01', '38 Nguyen Cong Tru Street', '2000-12-13', 'Male', 'Head Chief of Medicine', '1'),
		('Tram', 'B', '1993-11-11', '38 To Hien Thanh Street', '2010-04-05', 'Male', 'Surgical Attending Physician', '2'),
        ('Le', 'C', '1985-10-10', '38 Ly Thuong Kiet Street', '2012-06-06', 'Male', 'Psychiatrist', '3'),
        ('Hoang', 'D', '1983-12-23', '128 Nguyen Van Troi Street', '2014-07-03', 'Female', 'Plastic Surgery', '4'),
        ('Tran', 'E', '1997-12-12', '8A Cach Mang Thang Tam Street', '2010-04-15', 'Female', 'General Practice', '5'),
        ('Nguyen', 'F', '1990-09-01', '118 Xo Viet Nghe Tinh Street', '2013-10-01', 'Male', 'Emergency Medicine', '1'),
		('Tram', 'G', '1993-10-11', '120 Hoang Hoa Tham Street', '2006-05-22', 'Male', 'Neurosurgery', '2'),
        ('Le', 'H', '1985-01-10', '9A Pham Dinh Ho Street', '2000-01-06', 'Male', 'Cardiology', '3'),
        ('Hoang', 'I', '1983-02-23', '12B Vo Van Ngan Street', '2004-07-03', 'Female', 'Medical Genetic', '4'),
        ('Tran', 'J', '1997-11-12', '108D Cach Mang Thang Tam Street', '2012-05-15', 'Female', 'Oncology', '5')
;

INSERT INTO Employee(Fname, Lname, DOB, Address, StartDate, Gender, Speciality, DepartmentId)
VALUES 	('Nguyen', 'K', '1990-01-31', '38 Nguyen Cong Tru Street', '2000-12-13', 'Male', 'Neonatal Nurse', '1'),
		('Thai', 'L', '1993-07-11', '38 To Hien Thanh Street', '2010-04-05', 'Male', 'Nurse Midwife', '2'),
        ('Ha', 'M', '1985-10-10', '38 Ly Thuong Kiet Street', '2012-06-06', 'Male', 'Clinical Nurse', '3'),
        ('Hua', 'N', '1983-09-13', '128 Nguyen Van Troi Street', '2014-07-03', 'Female', 'Critical Care Nurse', '4'),
        ('Do', 'O', '1997-10-05', '8A Cach Mang Thang Tam Street', '2010-04-15', 'Female', 'Dialysis Nurse', '5')
;

CREATE TABLE EmpPhone (
	Id			int				NOT NULL,
    Phone		char(10)		NOT NULL,
    FOREIGN KEY (Id) REFERENCES EMPLOYEE(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id, Phone)
);

INSERT INTO EmpPhone( Id, Phone )
VALUES 	(1, '0909093222'),
		(1, '0909395555'),
        (2, '0989375947'),
		(2, '0945495295'),
        (2, '0852052592'),
        (3, '0952529572'),
		(3, '0872572992'),
        (3, '0952975299')
;

CREATE TABLE DOCTOR (
	Id		int		NOT NULL,
	FOREIGN KEY (Id) REFERENCES EMPLOYEE(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id)
);

CREATE TABLE NURSE (
	Id		int		NOT NULL,
	FOREIGN KEY (Id) REFERENCES EMPLOYEE(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id)
);

ALTER TABLE DEPARTMENT
ADD FOREIGN KEY (DeanId) REFERENCES DOCTOR(Id) ON UPDATE CASCADE;

ALTER TABLE EMPLOYEE
ADD FOREIGN KEY (DepartmentId) REFERENCES DEPARTMENT(Id) ON UPDATE CASCADE;


INSERT INTO DOCTOR(Id)
VALUES (1), (2), (3), (4), (5), (6), (7), (8), (9), (10);


INSERT INTO Nurse(Id)
VALUES (11), (12), (13), (14), (15);

CREATE TABLE PATIENT (
	Id			varchar(7)						NOT NULL,
	Fname		varchar(255)					NOT NULL,
    Lname		varchar(255)					NOT NULL,
    DOB			date,
    Phone		varchar(10),
    Address		varchar(255),
    Gender		set('Male', 'Female', 'Other'),
    PRIMARY KEY (Id)
);

CREATE TABLE INPATIENT (
	Id				varchar(7)				NOT NULL,
    AdmissionDate	date,
    DischargeDate	date,
    Fee				int,
    Diagnosis		varchar(255),
    SickRoom		varchar(255),
    NurseId			int,
    FOREIGN KEY (Id) REFERENCES PATIENT(Id) ON UPDATE CASCADE,
    FOREIGN KEY (NurseId) REFERENCES NURSE(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id)
);

CREATE TABLE OUTPATIENT (
	Id				varchar(7)				NOT NULL,
    FOREIGN KEY (Id) REFERENCES PATIENT(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id)
);

CREATE TABLE MEDICATION (
	Id		int		NOT NULL AUTO_INCREMENT,
    Mname	varchar(255)	NOT NULL,
    Effects	text,
    Price	int,
    PRIMARY KEY (Id)
);

CREATE TABLE EXAMINATION (
	Id			int 	NOT NULL AUTO_INCREMENT,
    PatientId	varchar(7)	NOT NULL,
    DoctorId	int,
    ExamDate	date	NOT NULL,
    Diagnosis		varchar(255),
    Fee			int		NOT NULL,
    SecondDate	date,
    FOREIGN KEY (PatientId) REFERENCES OUTPATIENT(Id) ON UPDATE CASCADE,
    FOREIGN KEY (DoctorId) REFERENCES DOCTOR(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id, PatientId)
);

CREATE TABLE TREATMENT (
	Id			int		NOT NULL AUTO_INCREMENT,
    PatientId	varchar(7)	NOT NULL,
    DoctorId	int,
	StartDate	date	NOT NULL,
    EndDate		date,
    Result		text,
    FOREIGN KEY (PatientId) REFERENCES INPATIENT(Id) ON UPDATE CASCADE,
    FOREIGN KEY (DoctorId) REFERENCES DOCTOR(Id) ON UPDATE CASCADE,
    PRIMARY KEY (Id, PatientId)
);

CREATE TABLE EXAM_MED (
	ExamId		int		NOT NULL,
    PatientId	varchar(7)	NOT NULL,
    MedId		int		NOT NULL,
	FOREIGN KEY (ExamId) REFERENCES EXAMINATION(Id) ON UPDATE CASCADE,
    FOREIGN KEY (PatientId) REFERENCES EXAMINATION(PatientId) ON UPDATE CASCADE,
    FOREIGN KEY (MedId) REFERENCES MEDICATION(Id) ON UPDATE CASCADE,
    PRIMARY KEY (ExamId, MedId, PatientId)
);

CREATE TABLE TREAT_MED (
	TreatId		int		NOT NULL,
    PatientId	varchar(7)	NOT NULL,
    MedId		int		NOT NULL,
	FOREIGN KEY (TreatId) REFERENCES TREATMENT(Id) ON UPDATE CASCADE,
    FOREIGN KEY (PatientId) REFERENCES TREATMENT(PatientId) ON UPDATE CASCADE,
    FOREIGN KEY (MedId) REFERENCES MEDICATION(Id) ON UPDATE CASCADE,
    PRIMARY KEY (TreatId, MedId, PatientId)
);

-- insert patients
INSERT INTO Patient(Id, Fname, Lname, DOB, Phone, Address, Gender)
VALUES 	('IP00001','Nguyen', 'An', '1999-03-14', '0908734232' ,'23 An Duong Vuong', 'Male'),
		('IP00002','Nguyen', 'Bao', '1989-12-23', '0903734254' ,'89 An Duong Vuong', 'Male'),
        ('IP00003','Le', 'Tu', '2000-04-15', '0903744452' ,'1024/334 Ly Thuong Kiet', 'Female'),
        ('IP00004','Tran', 'Hoang', '1999-04-30', '0944888999' ,'35 To Hien Thanh', 'Male'),
        ('IP00005','Nguyen', 'Kha', '1989-07-09', '0928334262' ,'73 Ly Thuong Kiet', 'Male'),
        ('IP00006','Le', 'Lam', '1977-03-26', '0909756277' ,'45 Hoang Van Thu', 'Female'),
        ('OP00001', 'Tran', 'Thanh', '2003-12-14', '0998758739' ,'59 Hoang Hoa Tham', 'Male'),
        ('OP00002','Hoang', 'Anh', '1997-05-02', '0908667668' ,'123 Hoa Hao', 'Female'),
        ('OP00003','Ly', 'Hoa', '1990-01-15', '0908556557' ,'23 An Duong Vuong', 'Female'),
        ('OP00004','Nguyen', 'Phuong', '1973-06-12', '0906574638' ,'52 Vo Truong Toan', 'Male'),
        ('OP00005','Nguyen', 'Tram', '1967-10-29', '0988909001' ,'33 Pham Van Dong', 'Female'),
        ('OP00006', 'Truong', 'Thu', '2001-07-29', '0988234242' ,'35 Nguyen Hien', 'Female')
;

INSERT INTO Inpatient(Id, AdmissionDate, DischargeDate, Diagnosis, Fee, SickRoom, NurseId)
VALUES 	('IP00001', '2019-10-11', '2020-11-11','sick', 1000000, '202', 12), 
		('IP00002', '2020-09-11', '2020-10-11','vomit', 4000000, '301', 11), 
        ('IP00003', '2019-12-03', '2020-06-18','headache', 7000000, '505', 12), 
        ('IP00004', '2020-05-11', '2020-05-20','sick', 1000000, '606', 13), 
        ('IP00005', '2020-05-14', '2020-05-30','sick', 750000, '909', 15), 
        ('IP00006', '2019-12-15', '2020-02-03','vomit', 3000000, '701A', 15)
;

-- SET FOREIGN_KEY_CHECKS=1;

INSERT INTO OutPatient(Id)
VALUES ('OP00001'), ('OP00002'), ('OP00003'), ('OP00004'), ('OP00005'), ('OP00006');

-- insert medication
INSERT INTO Medication(Mname, Effects, Price)
VALUES 	('Amphetamines', 'Lower high blood pressure', 10000),
		('Metformin', 'Decreases the liver''s production of glucose (sugar that provides energy to cells), makes cells more sensitive to the hormone insulin (which moves glucose into cells), and decreases the absorption of glucose from the intestine', 15000),
        ('Statins', 'Lower "bad" LDL cholesterol and have been shown to reduce the risk of heart attack, stroke, or death', 12000),
        ('Over-the-counter painkillers', 'Go-to drugs for fevers or headaches, and NSAIDs are also used for body aches.', 10000),
        ('Fluoroquinolone antibiotics', 'Treat sinus and urinary tract infections. They are prescribed less often today because of side effect concerns.', 10000)
;

-- insert examination
INSERT INTO Examination(PatientId, DoctorId, ExamDate, Diagnosis, Fee, SecondDate)
VALUES	('OP00001', 1, '2020-10-11', 'sick',500000, '2020-11-11'),
		('OP00001', 3, '2020-11-11', 'cough',500000, '2020-12-11'),
        ('OP00001', 4, '2021-01-11', 'cough',500000, '2020-02-11'),
        ('OP00001', 5, '2020-02-11', 'sick',500000, '2020-03-11'),
        ('OP00002', 2, '2019-02-03', 'sick',600000, '2019-08-03'),
        ('OP00002', 4, '2019-08-03', 'headache',750000, '2020-02-03'),
        ('OP00002', 9, '2020-02-03', 'broken legs',700000, '2020-08-03'),
        ('OP00002', 10, '2020-08-03', 'broken legs',700000, '2021-02-03')
;
        
-- insert examination medication
INSERT INTO Exam_med(ExamId, PatientId, MedId)
VALUES 	(1,'OP00001',2), 
		(1,'OP00001',3), 
		(2,'OP00001',4), 
        (2,'OP00001',5), 
        (2,'OP00001',1)
;

INSERT INTO Exam_med(ExamId, PatientId, MedId)
VALUES 	(5,'OP00002',5), 
        (5,'OP00002',1),
        (5,'OP00002',3), 
        (6,'OP00002',1),
		(6,'OP00002',3),
        (6,'OP00002',4)
;

-- insert treatment
INSERT INTO Treatment(PatientId, DoctorId, StartDate, EndDate, Result)
VALUES	('IP00001', 1, '2019-10-11', '2020-11-11', 'Good'),
		('IP00002', 3, '2020-09-11', '2020-10-11', 'Good'),
        ('IP00003', 4, '2019-12-03', '2020-06-18', 'Not very good'),
        ('IP00004', 10, '2020-05-11', '2020-05-20', 'Very good'),
        ('IP00005', 2, '2020-05-14', '2020-05-30', 'Good'),
        ('IP00006', 4, '2019-12-15', '2020-02-03', 'Good')
;
-- insert treatment medication
INSERT INTO Treat_med(TreatId, PatientId, MedId)
VALUES 	(1, 'IP00001', 3), 
		(1, 'IP00001', 4), 
		(2, 'IP00002', 5), 
        (2, 'IP00002', 1), 
        (2, 'IP00002', 3), 
        (3, 'IP00003', 1), 
        (3, 'IP00003', 2), 
        (3, 'IP00003',4)
;

CREATE TABLE DBA (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO DBA(username, password)
VALUES 	('admin', 'admin');

DROP TRIGGER IF EXISTS checkInpatientId;
DELIMITER //
CREATE TRIGGER checkInpatientId BEFORE INSERT ON INPATIENT
FOR EACH ROW
BEGIN
    IF NOT( NEW.Id LIKE 'IP%' ) THEN
        SIGNAL SQLSTATE '12345' SET MESSAGE_TEXT = 'Inpatient Id must begin with IP';
    END IF;
END //
DELIMITER ;

DROP TRIGGER IF EXISTS checkOutpatientId;
DELIMITER //
CREATE TRIGGER checkOutpatientId BEFORE INSERT ON OUTPATIENT
FOR EACH ROW
BEGIN
    IF NOT( NEW.Id LIKE 'OP%' ) THEN
        SIGNAL SQLSTATE '12345' SET MESSAGE_TEXT = 'Inpatient Id must begin with IP';
    END IF;
END //
DELIMITER ; 

-- Trigger for the Dean of an aparment:
-- The dean must hold a specific speciality and has had more than
-- 5 years of experience since the date he or she was awarded the
-- speciality degree
DROP TRIGGER IF EXISTS deanConstraints_update;
DELIMITER //
CREATE TRIGGER deanConstraints_update
BEFORE UPDATE ON DEPARTMENT
FOR EACH ROW
BEGIN
    DECLARE dean_year INT;
    DECLARE current_year INT;
    SET dean_year = (
        SELECT EXTRACT(YEAR FROM EMPLOYEE.BDATE)
        WHERE EMPLOYEE.Id = NEW.DeanId
    );
    SET current_year = EXTRACT(YEAR FROM SYSDATE());

    IF current_year - dean_year < 5 THEN SIGNAL SQLSTATE '77777'
        SET MESSAGE_TEXT = 'The Dean must had more than 5 year of experience in his speciality!' ;
    END IF;
END //
DELIMITER ;

DROP TRIGGER IF EXISTS deanConstraints_insert;
DELIMITER //
CREATE TRIGGER deanConstraints_insert
BEFORE INSERT ON DEPARTMENT
FOR EACH ROW
BEGIN
    DECLARE dean_year INT;
    DECLARE current_year INT;
    SET dean_year = (
        SELECT EXTRACT(YEAR FROM EMPLOYEE.BDATE)
        WHERE EMPLOYEE.Id = NEW.DeanId
    );
    SET current_year = EXTRACT(YEAR FROM SYSDATE());

    IF current_year - dean_year < 5 THEN SIGNAL SQLSTATE '77777'
        SET MESSAGE_TEXT = 'The Dean must had more than 5 year of experience in his speciality!' ;
    END IF;
END //
DELIMITER ;

-- a. Increase Inpatient Fee to 10% for all the inpatients who are admitted to hospital
-- from 01/09/2020. (0.5 mark)
SET SQL_SAFE_UPDATES = 0;
UPDATE Inpatient
SET Fee = 1.1 * Fee
WHERE AdmissionDate > '2020-09-01';
SET SQL_SAFE_UPDATES = 1;

-- b. Select all the patients (outpatient & inpatient) of the doctor named 
-- ‘Nguyen Van A’. (0.5 mark)
SELECT * FROM Patient
WHERE Id in (
	SELECT Inpatient.Id 
    FROM Inpatient, Treatment, Doctor
	WHERE Inpatient.Id = Treatment.PatientId AND Treatment.DoctorId IN (
		SELECT Doctor.Id
        FROM Doctor, Employee
        WHERE Doctor.Id = Employee.Id AND Employee.Fname LIKE 'Nguyen' AND Employee.Lname LIKE 'A'
    )
    UNION
    SELECT Outpatient.Id 
    FROM Outpatient, Examination, Doctor
	WHERE Outpatient.Id = Examination.PatientId AND Examination.DoctorId IN (
		SELECT Doctor.Id
        FROM Doctor, Employee
        WHERE Doctor.Id = Employee.Id AND Employee.Fname LIKE 'Nguyen' AND Employee.Lname LIKE 'A'
    )
);


-- c. Write a function to calculate the total medication price a patient has to pay for
-- each treatment or examination (1 mark).
-- Input: Patient ID
-- Output: A list of payment of each treatment or examination
DROP PROCEDURE IF EXISTS getTotalMedPrice;
delimiter //
CREATE PROCEDURE getTotalMedPrice( pid varchar(7) )
BEGIN
	SELECT patient_exs.Id AS 'Exam Or Treat Id', SUM(Price) AS 'Total Price'
	FROM Medication, (
		SELECT ExamId AS Id, PatientId, MedId
			FROM Exam_Med
			WHERE Exam_Med.PatientId = pid
		UNION 
		SELECT TreatId AS Id, PatientId, MedId
			FROM Treat_Med
			WHERE Treat_Med.PatientId = pid) AS patient_exs
	WHERE Medication.Id = patient_exs.MedId
    GROUP BY patient_exs.Id;
END; //
delimiter ;

CALL getTotalMedPrice('OP00001');

-- d. Write a procedure to sort the doctor in increasing number of patients he/she
-- takes care in a period of time (1 mark).
-- Input: Start date, End date
-- Output: A list of sorting doctors.
DROP PROCEDURE IF EXISTS getDoctors;
delimiter //
CREATE PROCEDURE getDoctors(startD date, endD date )
BEGIN
	SELECT DoctorId, Employee.Fname, Employee.Lname, SUM(Total) AS TotalPatient FROM 
	(
		SELECT DoctorId, COUNT(PatientId) AS Total
		FROM Examination 
		WHERE ExamDate >= startD AND ExamDate <= endD
		GROUP BY DoctorId
		UNION ALL
		SELECT DoctorId, COUNT(PatientId) AS Total
		FROM Treatment
		WHERE StartDate >= startD AND EndDate <= endD
		GROUP BY DoctorId
	) AS A, Employee
	WHERE Employee.Id = DoctorId
	GROUP BY DoctorId
	ORDER BY TotalPatient ASC;
END; //
delimiter ;

CALL getDoctors('2020-01-01', '2020-12-31');



