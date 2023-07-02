from flask_marshmallow import Marshmallow

ma = Marshmallow()

class HorarioSchema(ma.Schema):
    class Meta:
        fields = ('id', 'day', 'active_morning', 'morning_start', 'morning_end', 'active_afternoon',
                  'afternoon_start', 'afternoon_end', 'user_id')

horario_schema = HorarioSchema()
horarios_schema = HorarioSchema(many=True)
