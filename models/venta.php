<?php
class MensajesModelVentas{
    private $id_venta;
    private $id_usuario;
    private $id_metodo_pago;
    private $fecha;
    private $cantidad;
    private $precio;
    private $sub_total;

    private $db;

    public function __construct(){
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    public function traerId_Venta($id_usuario){
        $query = "SELECT MAX(id_venta) as id_venta 
        FROM venta 
        WHERE id_usuario = :id_usuario";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $rs->execute();
        $id_venta = $rs->fetchColumn();
        return $id_venta;
    }
    public function getFecha($id_venta){
        $query = "SELECT fecha FROM venta WHERE id_venta = :id_venta";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_venta', $id_venta, PDO::PARAM_STR);
        $rs->execute();
        $fecha = $rs->fetchColumn();
        return $fecha;
    }

    public function getCantidadProducto ($id_venta){
        $query = "SELECT (COUNT(*)*cantidad) as cantidad_producto 
        FROM venta_detalle 
        WHERE id_venta = :id_venta";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_venta', $id_venta, PDO::PARAM_STR);
        $rs->execute();
        $cantidad_producto = $rs->fetchColumn();
        return $cantidad_producto;
    }


    public function getSubTotal($id_venta){
        $query = "SELECT COALESCE(SUM(sub_total),0) AS sub_total 
        FROM venta_detalle 
        WHERE id_venta= :id_venta";
        $rs = $this->db->prepare($query);
        $rs -> bindParam(':id_venta', $id_venta);
        $rs->execute();
        $sub_total = $rs->fetchColumn();
        return $sub_total;
    }

    public function getTotal($id_venta, $costo_envio) {
        $query = "SELECT (SUM(sub_total) + :costo_envio) AS sub_total 
                  FROM venta_detalle 
                  WHERE id_venta = :id_venta";
    
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_venta', $id_venta);
        $rs->bindParam(':costo_envio', $costo_envio, PDO::PARAM_INT);
        $rs->execute();
    
        $sub_total = $rs->fetchColumn();
        return $sub_total;
    }
    
    public function getDireccion ($id_usuario){
        $query = "SELECT p.pais, e.estado, c.ciudad, d.calle, d.num_casa, d.latitud, d.longitud 
        FROM usuario us 
        INNER JOIN direccion d ON d.id_direccion = us.id_direccion 
        INNER JOIN ciudad c ON c.id_ciudad = d.id_ciudad 
        INNER JOIN estado e ON e.id_estado = c.id_estado 
        INNER JOIN pais p ON p.id_pais = e.id_pais 
        WHERE us.id_usuario = :id_usuario";
        $rs = $this->db->prepare($query);
        $rs -> bindParam(':id_usuario', $id_usuario);
        $rs->execute();
        $res = $rs -> fetch(PDO::FETCH_ASSOC);
        return $res;
    } 

    public function getInfoUsuario($id_usuario){
        $query = "SELECT nombre, apellido_p, apellido_m, email 
        FROM usuario 
        WHERE id_usuario = :id_usuario";
        $rs = $this->db->prepare($query);
        $rs -> bindParam(':id_usuario', $id_usuario);
        $rs->execute();
        $res = $rs -> fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    public function getInfoPago($id_venta){
        $query = "SELECT mp.metodo_pago 
        FROM venta v 
        INNER JOIN metodo_pago mp ON mp.id_metodo_pago = v.id_metodo_pago 
        WHERE v.id_venta = :id_venta";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_venta', $id_venta, PDO::PARAM_STR);
        $rs->execute();
        $metodo_pago = $rs->fetchColumn();
        return $metodo_pago;
    }

    public function getVenta($id_venta){
        $query = "SELECT l.portada, l.nombre, vd.cantidad, t.precio, vd.sub_total 
        FROM venta v
        INNER JOIN venta_detalle vd ON vd.id_venta=v.id_venta 
        INNER JOIN libro l ON l.id_libro=vd.id_libro 
        INNER JOIN tipo_libro t ON t.id_libro=l.id_libro
        WHERE v.id_venta = :id_venta AND t.id_tipo = 1";
        $rs = $this->db->prepare($query);
        $rs -> bindParam(':id_venta', $id_venta);
        $rs->execute();
        $rs;
        $res = $rs -> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

}
?>