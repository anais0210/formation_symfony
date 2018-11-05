
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE student (
id uuid DEFAULT uuid_generate_v4 (),
lastname VARCHAR(30) NOT NULL,
firstname VARCHAR(30) NOT NULL,
birthDate DATE
);

