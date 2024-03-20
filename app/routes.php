<?php
// Defined a few routes "url"=>"controller,method"
$this->addRoute('User/register', 'User,register');
$this->addRoute('User/login', 'User,login');
$this->addRoute('User/logout', 'User,logout');
$this->addRoute('User/update', 'User,update');
$this->addRoute('User/delete', 'User,delete');
$this->addRoute('User/securePlace', 'Profile,index');
$this->addRoute('Profile/index', 'Profile,index');
$this->addRoute('Profile/create', 'Profile,create');
$this->addRoute('Profile/modify', 'Profile,modify');
$this->addRoute('Profile/delete', 'Profile,delete');

// Publication Routes
$this->addRoute('Publication/index', 'Publication,index');
$this->addRoute('Publication/create', 'Publication,create');
$this->addRoute('Publication/modify/{publication_id}', 'Publication,modify');
$this->addRoute('Publication/delete/{publication_id}', 'Publication,delete');

$this->addRoute('Publication/view/{publication_id}', 'Publication,show');

// Publication Comment Routes
$this->addRoute('PublicationComment/add', 'PublicationComment,add');

// $this->addRoute('PublicationComment/modify/{comment_id}', 'PublicationComment,modify');
// $this->addRoute('PublicationComment/delete/{comment_id}', 'PublicationComment,delete');

// Example Routes
$this->addRoute('Example/index', 'Example,index');
$this->addRoute('Example/clock', 'Example,clock');
$this->addRoute('Example/passingData', 'Example,passingData');
$this->addRoute('Example/count', 'Example,count');

// Setting the publication index as the landing page
$this->addRoute('/', 'Publication,index');
