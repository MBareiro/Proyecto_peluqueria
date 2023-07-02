from app import db, app

# Modelo para la tabla Disponibilidad
class Disponibilidad(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    descripcion = db.Column(db.String(255))

    def __init__(self, descripcion):
        self.descripcion = descripcion

with app.app_context():
    db.create_all()  # aqui crea todas las tablas
