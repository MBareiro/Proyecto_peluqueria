from flask_marshmallow import Marshmallow

ma = Marshmallow()

class PasswordResetSchema(ma.Schema):
    class Meta:
        fields = ('id', 'email', 'token', 'codigo', 'fecha')

password_reset_schema = PasswordResetSchema()
password_resets_schema = PasswordResetSchema(many=True)
