<?php 
include("../../bd.php");
if($_POST){

    $comentario=(isset($_POST["comentario"]))?$_POST["comentario"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    
    $sentencia = $conexion->prepare("INSERT INTO 
    `tbl_comentarios` (`ID`, `comentario`, `nombre`) 
    VALUES (NULL,:comentario,:nombre);");

    $sentencia->bindParam(":comentario",$comentario);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->execute();
    header("Location:index.php");
}
include ("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">Comentarios</div>
    <div class="card-body">
        <form action="" method="post">

        <div class="mb-3">
            <label for="" class="form-label">Comentario:</label>
            <input type="text" class="form-control" name="comentario" id="comentario" aria-describedby="helpId" placeholder="Comentario"/>
            
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre"/>
        </div>
        
        <button type="submit" class="btn btn-success">Agregar comentarios</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include ("../../templates/footer.php"); ?>