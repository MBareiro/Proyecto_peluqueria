from flask_marshmallow import Marshmallow

ma = Marshmallow()

class UserSchema(ma.Schema):
    class Meta:
        fields = ('id', 'nombre', 'apellido', 'email', 'email_verified_at', 'rol', 'remember_token', 'created_at', 'updated_at')

user_schema = UserSchema()
users_schema = UserSchema(many=True)
