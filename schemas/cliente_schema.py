from flask_marshmallow import Marshmallow
ma = Marshmallow()

class ClienteSchema(ma.Schema):
    class Meta:
        fields = ('id', 'nombre', 'apellido', 'email', 'telefono', 'created_at', 'updated_at')

cliente_schema = ClienteSchema()
clientes_schema = ClienteSchema(many=True)
