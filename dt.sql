-- doctor
CREATE TABLE doctor (
    id_doctor int not null PRIMARY KEY auto_increment,
    name_doctor VARCHAR(50) not null,
    email varchar(255) not null unique,
    password varchar(255) not null,
    phone VARCHAR(10) not null,
    address varchar(255) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null
);

-- patient
CREATE TABLE patient (
    id int not null PRIMARY KEY auto_increment,
    name_patient VARCHAR(50) not null,
    email varchar(255) null unique,
    password varchar(255) null,
    phone VARCHAR(10) not null,
    weight int,
    blood_group VARCHAR(10),
    gender VARCHAR(10) not null,
    CCCD VARCHAR(20) null,
    birthday date not null,
    address varchar(255) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null
);

-- type_medicine
CREATE TABLE type_medicine (
    id_typeMedicine varchar(10) PRIMARY KEY not null,
    name_typeMedicine varchar(50) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null
);

-- drug
CREATE TABLE drug (
    id_drug varchar(10) PRIMARY KEY not null,
    name_drug VARCHAR(50) not null,
    max_dose_time float not null,
		min_dose_time float not null,
    max_frequency_day int not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null
);

-- unit_drug
CREATE TABLE unit_drug (
    id_unitDr varchar(10) PRIMARY KEY not null,
    name_unitDr varchar(20) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null
);

-- detail_drug
CREATE TABLE detail_drug (
    id_typeMedicine varchar(10) not null,
    id_drug varchar(10) not null,
    id_unitDr varchar(10) not null,
    function_drug varchar(100) not null,
    dose float not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null,
    FOREIGN KEY (id_typeMedicine) REFERENCES type_medicine(id_typeMedicine),
    FOREIGN KEY (id_drug) REFERENCES drug(id_drug),
    FOREIGN KEY (id_unitDr) REFERENCES unit_drug(id_unitDr)
);

-- prescription
CREATE TABLE prescription (
    id_prescription int not null PRIMARY KEY auto_increment,
    id_patient int not null,
    id_doctor int not null,  
		diagnose varchar(225) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null,
    FOREIGN KEY (id_patient) REFERENCES patient(id),
    FOREIGN KEY (id_doctor) REFERENCES doctor(id_doctor)
);

-- detail_prescription
CREATE TABLE detail_prescription (
    id_prescription int not null,
    id_drug varchar(10) not null,
    name_unitDr varchar(20) not null,
    frequency int not null,
    quantity_Ofmedicine float not null,
    note varchar(225) not null,
    user_manual varchar(225) not null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP null,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP null,
    FOREIGN KEY (id_prescription) REFERENCES prescription(id_prescription),
    FOREIGN KEY (id_drug) REFERENCES drug(id_drug)
);

INSERT INTO type_medicine (id_typeMedicine, name_typeMedicine)
VALUES
('TM1', 'Thuốc kháng sinh'),
('TM2', 'Thuốc chống viêm'),
('TM3', 'Thuốc chống dị ứng'),
('TM4', 'Thuốc chống co giật'),
('TM5', 'Thuốc tim mạch'),
('TM6', 'Thuốc giảm đau'),
('TM7', 'Thuốc trị tâm thần'),
('TM8', 'Thuốc điều trị tiểu đường'),
('TM9', 'Thuốc chống ung thư'),
('TM10', 'Thuốc chống vi-rút');
INSERT INTO drug (id_drug, name_drug, max_dose_time,min_dose_time, max_frequency_day)
VALUES
('D1', 'Amoxicillin', 500,180, 3),
('D2', 'Penicillin', 1000,400,2),
('D3', 'Cephalexin', 750,225, 2),
('D4', 'Ibuprofen', 800,200, 3),
('D5', 'Naproxen', 550,50, 2),
('D6', 'Aspirin', 1000,150, 3),
('D7', 'Claritin', 10,9, 1),
('D8', 'Zyrtec', 10,10, 1),
('D9', 'Benadryl', 50,40, 3),
('D10', 'Phenytoin', 300, 200,2),
('D11', 'Diazepam', 10,10 ,3),
('D12', 'Carbamazepine', 1200,700, 2),
('D13', 'Lisinopril', 40,20, 1),
('D14', 'Atenolol', 100, 30,2),
('D15', 'Acetaminophen', 1000,200, 2),
('D16', 'Codeine', 60,20, 3),
('D17', 'Oxycodone', 30,10, 3),
('D18', 'Risperidone', 8, 150,2),
('D19', 'Sertraline', 200,200, 1),
('D20', 'Lithium', 900, 400,2),
('D21', 'Insulin', 50,40, 2),
('D22', 'Metformin', 2000,1500, 2),
('D23', 'Glyburide', 10, 3,3),
('D24', 'Doxorubicin', 75,60, 1),
('D25', 'Paclitaxel', 175,150, 1),
('D26', 'Tamoxifen', 40,175, 1),
('D27', 'Tenofovir', 300,30, 1),
('D28', 'Oseltamivir', 75,200, 2);	
INSERT INTO unit_drug (id_unitDr, name_unitDr)
VALUES
    ('UD01', 'Viên'),
    ('UD02', 'Gói'),
    ('UD03', 'Ống'),	
		('UD04', 'Hủy'),
		('UD05', 'Quả'),
		('UD06', 'Ống'),
		('UD07', 'Lọ'),
		('UD08', 'Chai');
INSERT INTO detail_drug (id_typeMedicine, id_drug, id_unitDr, function_drug, dose)
VALUES
    ('TM1', 'D1', 'UD01', 'Kháng sinh', 90),
    ('TM2', 'D2', 'UD02', 'Chống viêm', 200),
    ('TM5', 'D3', 'UD01', 'Tim mạch', 75),
    ('TM9', 'D4', 'UD01', 'Chống ung thư', 200),
    ('TM3', 'D5', 'UD01', 'Dị ứng', 50),
    ('TM6', 'D6', 'UD01', 'Giảm đau', 150),
    ('TM7', 'D7', 'UD02', 'Hạ huyết áp', 9),
    ('TM4', 'D8', 'UD01', 'Chống co giật', 10),
    ('TM9', 'D9', 'UD01', 'Chống ung thư', 40),
    ('TM8', 'D10', 'UD01', 'Tiểu đường', 100),
    ('TM5', 'D11', 'UD01', 'Tim mạch', 10),
    ('TM6', 'D12', 'UD01', 'Giảm đau', 700),
    ('TM2', 'D13', 'UD01', 'Chống viêm', 20),
    ('TM1', 'D14', 'UD01', 'Kháng sinh', 10),
    ('TM7', 'D15', 'UD01', 'Hạ huyết áp', 200),
    ('TM6', 'D16', 'UD01', 'Giảm đau', 20),
    ('TM10', 'D17', 'UD01', 'Chống vi-rút', 5),
    ('TM3', 'D18', 'UD01', 'Dị ứng', 150),
    ('TM4', 'D19', 'UD01', 'Chống co giật', 200),
    ('TM2', 'D20', 'UD01', 'Chống viêm', 400),
    ('TM4', 'D21', 'UD01', 'Chống co giật', 40),
    ('TM10', 'D22', 'UD01', 'Chống vi-rút', 1500),
    ('TM3', 'D23', 'UD01', 'Dị ứng', 3),
    ('TM5', 'D24', 'UD01', 'Tim mạch', 60),
    ('TM7', 'D25', 'UD01', 'Hạ huyết áp', 150),
    ('TM9', 'D26', 'UD01', 'Chống ung thư', 175),
    ('TM1', 'D27', 'UD01', 'Kháng sinh', 30),
    ('TM6', 'D28', 'UD01', 'Giảm đau', 200)