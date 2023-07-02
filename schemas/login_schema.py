from flask_marshmallow import Marshmallow

ma = Marshmallow()

class LoginSchema(ma.Schema):
    class Meta:
        fields = ('id', 'username', 'password', 'user_id')

login_schema = LoginSchema()
logins_schema = LoginSchema(many=True)
