<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('Unit_model');
    $this->load->library('session');
    $this->load->helper('url');
  }

  //LIST (& INSERT) VIEW
  public function index()
  {
    $data['units'] = $this->Unit_model->get_units();
    foreach ($data['units'] as $unit) {
      $unit->students_count = $this->Unit_model->get_students_count($unit->id);
    }
    $this->load->view('unit/list', $data);
  }

  //EDIT VIEW
  public function editView($id)
  {
    $unit = $this->Unit_model->get_unit($id);
    if (empty($unit)) {
      $this->session->set_flashdata('error', 'Turma não encontrada.');
      redirect('turmas');
    }
    $data['unit'] = $unit;
    $this->load->view('unit/edit', $data);
  }

  //SAVE
  public function save()
  {
    if ($this->input->post()) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'nome', 'required');
      $this->form_validation->set_rules('teacher', 'professor', 'required');
      
      if ($this->form_validation->run())
      {
        $data = array(
          'name' => $this->input->post('name'),
          'teacher' => $this->input->post('teacher')
        );
        $this->Unit_model->insert_unit($data);
        $this->session->set_flashdata('success', 'Turma adicionada!');
      }
      else
      {
        $this->session->set_flashdata('error', validation_errors());
      }   
    }
    else
    {
      $this->session->set_flashdata('error', 'Método inválido');
    }

    redirect('turmas');
  }

  //UPDATE
  public function update($id)
  {
    if ($this->input->post())
    {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Nome', 'required');
      $this->form_validation->set_rules('teacher', 'professor', 'required');
      
      if ($this->form_validation->run())
      {
        $data = array(
          'name' => $this->input->post('name'),
          'teacher' => $this->input->post('teacher')
        );
        $this->Unit_model->update_unit($id, $data);
        $this->session->set_flashdata('success', 'Dados da turma atualizados');
      }
      else
      {
        $this->session->set_flashdata('error', validation_errors());
        redirect("turma/editar/{$id}");
      }   
    }
    else
    {
      $this->session->set_flashdata('error', 'Método inválido');
    }
    redirect('turmas');
  }

  //DELETE
  public function delete($id)
  {
    $unit = $this->Unit_model->get_unit($id);
    if ($unit)
    {
      $this->Unit_model->delete_unit($id);
      $this->session->set_flashdata('success', 'Turma excluída');
    }
    else
    {
      $this->session->set_flashdata('error', 'Turma não encontrada');
    }
    redirect('turmas');
  }
}
?>