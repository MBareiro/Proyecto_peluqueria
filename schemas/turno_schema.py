from flask_marshmallow import Marshmallow

ma = Marshmallow()

class TurnoSchema(ma.Schema):
    class Meta:
        fields = ('id', 'fecha', 'hora', 'cliente_id', 'peluquero_id', 'servicio_id', 'created_at', 'updated_at')

turno_schema = TurnoSchema()
turnos_schema = TurnoSchema(many=True)
