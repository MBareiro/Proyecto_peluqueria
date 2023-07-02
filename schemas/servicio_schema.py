from flask_marshmallow import Marshmallow

ma = Marshmallow()

class ServicioSchema(ma.Schema):
    class Meta:
        fields = ('id', 'descripcion', 'precio', 'duracion', 'created_at', 'updated_at')

servicio_schema = ServicioSchema()
servicios_schema = ServicioSchema(many=True)
