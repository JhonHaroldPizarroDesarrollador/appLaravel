<?php
switch ( $_POST["opcion"]){
      case 1: //Agregar
          $query = "INSERT INTO costos(descripcion,comentarios,tipo) VALUES('". utf8_decode($_POST["descripcion"]) ."','". utf8_decode($_POST["comentarios"]) ."','". $_POST["tipo"] ."')";
          $resultado = mysqli_query($con, $query);
            if( $resultado ) //Se realizó el registro
            {
              $retorno["estado"] = "OK";
            }
            else //Error al actualizar
            {
              $retorno["estado"] = "ERROR";
              $retorno["msg"] = mysqli_error($con);
            }
        break;
      case 2: //Actualizar
          if( empty($_POST["descripcion"]) )
          {
            $retorno["estado"] = "ERROR";
            $retorno["msg"] = "Parámetros incompletos";
          }
          else
          {
            $query = "UPDATE costos SET descripcion='". utf8_decode($_POST["descripcion"]) ."',comentarios='". utf8_decode($_POST["comentarios"]) ."'  WHERE idCostos='". $_POST["id"] ."'";
            $resultado = mysqli_query($con, $query);
            if( $resultado ) //Se realizó el registro
            {
              $retorno["estado"] = "OK";
            }
            else //Error al actualizar
            {
              $retorno["estado"] = "ERROR";
              $retorno["msg"] = mysqli_error($con);
            }
          }
        break;
      case 3:
          //Borrar
          $query = "DELETE FROM costos WHERE idCostos='". $_POST["idCostos"] ."'";
          $resultado = mysqli_query($con, $query);
          if( $resultado ) //Se realizó el registro
          {
            $retorno["estado"] = "OK";
          }
          else //Error al actualizar
          {
            $retorno["estado"] = "ERROR";
            $retorno["msg"] = mysqli_error($con);
          }
        break;
      case 4:
          //Consultar todos
          $query = " SELECT * FROM costos WHERE tipo='2' ";
          $resultado = mysqli_query($con, $query);
          $costos = array();
          while( $row = mysqli_fetch_array( $resultado ) )
          {
            $costos[] = array(
                                "id" => $row["idCostos"],
                                "descripcion" => utf8_encode($row["descripcion"]),
                                "comentarios" =>  utf8_encode($row["comentarios"])
                              );
          }
          if( count($costos) > 0)
          {
            $retorno["estado"] = "OK";
            $retorno["costos"] = $costos;
          }else{
            $retorno["estado"] = "EMPTY";
          }
        break;
    }
