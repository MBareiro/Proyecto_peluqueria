from flask_marshmallow import Marshmallow

ma = Marshmallow()

class RolSchema(ma.Schema):
    class Meta:
        fields = ('id', 'descripcion')

rol_schema = RolSchema()
roles_schema = RolSchema(many=True)
