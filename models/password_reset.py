from app import db, app

# Modelo para la tabla PasswordResets
class PasswordReset(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    email = db.Column(db.String(255))
    token = db.Column(db.String(255))
    codigo = db.Column(db.String(255))
    fecha = db.Column(db.DateTime)

    def __init__(self, email, token, codigo, fecha):
        self.email = email
        self.token = token
        self.codigo = codigo
        self.fecha = fecha

with app.app_context():
    db.create_all()  # aqui crea todas las tablas
