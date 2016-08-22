<style type="text/css">
    *{
        padding: 0px;
        margin: 0px;
    }
    #cargamodulos{
        margin: auto;
        width: 100%;
    }
    ul{
        list-style: none;
        text-align: left;
    }
    #nav li p{
        padding-right: 40px;
        display: block;
    }
    p{
        font-size: 17px;
    }
    #nav > li{
        float: left;
    }
    #nav li ul li{
        padding-left: 10px;
        display: block;
    }
</style>
<body>
    <script src="<?php echo base_url();?>Librerias/JavaScript/ValidarPermisos.js"></script> 
    <div class="container" style="width:100%;">     
        <center><h5 style="font-size:15px;"><b> Gestion De Permisos </b></h5></center>
        <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div> <br>

        <form class="form-horizontal" id="holaform" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-4 control-label">Seleccione Perfil </label>
                <div class="col-sm-3">
                    <select class="form-control" name="codcargo" id="cargo">
                        <option  value="cargo" > Seleccione </option>
                        <?php foreach ($tipousu as $key => $value): ?>
                            <option value="<?php echo $value["codcargo"]; ?>" ><?php echo $value["descripcion"]; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <center><button type="button" class="btn btn-info btn-xs" id="graba" >Guardar Cambios</button> </center>
                </div>
            </div>
            <div style="width: 100%;height: 1px; background-color: #D8D8D8;"></div><br>

            <div id="cargamodulos" ></div> 
        </form>
    </div>
</body>




