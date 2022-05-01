<?php
require "MySQL.php";
$index = "http://localhost:8080/index.php";
$sql = new MySQL($index);


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'PUT':
    $data = getData();
    $sql->put($data);
    echo json_encode($data);
    break;

  case 'POST':
    header("HTTP/1.1 200 OK");
    $data = getData();
    $sql->post($data);
    echo json_encode(true);
    break;

  case 'GET':
    if(isset($_GET['id'])){
      $imp = array();
      $imp=$sql->getID($_GET['id']);
    }else{

      if(isset($_GET['page'])){
        $page = $_GET['page'];
      }else{
        $page = 0;
      }
      if(isset($_GET['size'])){
        $size = $_GET['size'];
      }else{
        $size = 20;
      }
    $result = $sql->get($pase,$size);
    $employees=array();
    $imp = array();
    $tot = $sql->count();

    $links ['first']['href']='http://localhost:8080/index.php?page=0&size='.$size; 
    $links ['self']['href']=$index.'?page='.$page.'&size='.$size;
    $links ['next']['href']=$index.'?page='.($page+1).'&size='.$size;
    $links ['prev']['href']=$index.'?page='.($page-1).'&size='.$size;
    $links ['last']['href']=$index.'?page='.intval($tot/20).'&size='.$size;

    $pages = array('size'=>$size, 'totalElements'=>$tot, 'totalPages'=>intval($tot/20), 'number'=>intval($page));

    $imp['_embedded']['employees']=$sql->get($page, $size);
    $imp['_links']=$links;
    $imp['page']=$pages;

    }
    header('Content-Type: application/hal+json;charset=UTF-8');
    echo json_encode($imp, JSON_UNESCAPED_SLASHES);
    break;

  case 'DELETE':
    header("HTTP/1.1 200 OK");
    $id = $_GET['id'];
    $sql->delete($id);
    echo json_encode(true);
    break;
}

function getData(){
  $data = file_get_contents('php://input');
  return json_decode($data);
}

?>
