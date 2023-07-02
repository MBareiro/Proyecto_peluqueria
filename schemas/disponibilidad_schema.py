from flask_marshmallow import Marshmallow

ma = Marshmallow()

class DisponibilidadSchema(ma.Schema):
    class Meta:
        fields = ('id', 'descripcion')

disponibilidad_schema = DisponibilidadSchema()
disponibilidades_schema = DisponibilidadSchema(many=True)
