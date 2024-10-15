Create Schema chapweb_ucs;
use chapweb_ucs;

create table users (

	user_id INT not null auto_increment,
    user_email varchar(45) not null,
    user_password varchar(45) not null,
    first_name varchar(45) not null,
    last_name varchar(45) not null,
    admin_level INT not null default 0,

    primary key (user_id),
    unique user_email_unique (user_email)

);

create table categories (

	category_id INT not null,
    category_description varchar(30),
    
    primary key (category_id),
    unique category_description_unique (category_description)

);

create table UCS_events (

	event_id INT not null auto_increment,
    event_name varchar(45) not null,
    posting_begin_date datetime not null,
    posting_end_date datetime not null,
    event_begin_date datetime not null,
    event_end_date datetime not null,
    operator_code varchar(8) not null,
    
    constraint operator_code_min_length
    check (length(operator_code)>=8),
    
    primary key (event_id),
    unique event_name_unique (event_name)

);

create table items (

	book_id INT not null auto_increment,
    user_id INT not null,
    condition_id INT,
    category_id INT not null,
    event_id INT not null,
    ISBN INT,
    title varchar(90) not null,
    author varchar(90),
    price decimal(65,2) not null,
    year_published INT,
    qty INT not null default 1,
    donation boolean not null,
    sold boolean not null default 0,
    
    primary key (book_id),
    unique index book_id_unique_index (book_id),
    
    constraint user_id_books_fk
    foreign key (user_id)
    references users (user_id),
    
    constraint condition_id_books_fk
    foreign key (condition_id)
    references conditions (condition_id),
    
    constraint category_id_books_fk
    foreign key (category_id)
    references categories (category_id),
    
    constraint event_id_books_fk
    foreign key (event_id)
    references UCS_events (event_id)

);