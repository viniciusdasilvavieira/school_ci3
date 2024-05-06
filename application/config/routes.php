<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'School';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//            MAIN / SCHOOL ROUTES
$route[''] = 'School/index';

$route['alunos'] = 'School/studentsView';
$route['turmas'] = 'School/unitsView';

$route['enturmar'] = 'School/assignMenuView';

$route['enturmar/criar'] = 'School/assignCreateView';
$route['enturmar/criar/enviar'] = 'School/assign'; //POST

$route['enturmar/limpar'] = 'School/assignClearView';
$route['enturmar/limpar/enviar/(:num)'] = 'School/clear/$1'; //POST

$route['relatorio'] = 'School/report';


//            STUDENT ROUTES
$route['aluno/editar/(:num)'] = 'Student/editView/$1';
$route['aluno/salvar'] = 'Student/save'; //POST
$route['aluno/atualizar/(:num)'] = 'Student/update/$1'; //POST
$route['aluno/excluir/(:num)'] = 'Student/delete/$1';


//            UNIT ROUTES (Class / Turma) //I'm calling it unit to avoid conflicts with "Class"
$route['turma/editar/(:num)'] = 'Unit/editView/$1';
$route['turma/salvar'] = 'Unit/save'; //POST
$route['turma/atualizar/(:num)'] = 'Unit/update/$1'; //POST
$route['turma/excluir/(:num)'] = 'Unit/delete/$1';
