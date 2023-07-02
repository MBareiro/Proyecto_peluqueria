from app import db, app

# Modelo para la tabla Servicios
class Servicio(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    descripcion = db.Column(db.String(255))
    precio = db.Column(db.Float)
    duracion = db.Column(db.Integer)
    created_at = db.Column(db.DateTime)
    updated_at = db.Column(db.DateTime)
    turnos = db.relationship('Turno', backref='servicio')

    def __init__(self, descripcion, precio, duracion):
        self.descripcion = descripcion
        self.precio = precio
        self.duracion = duracion
        
with app.app_context():
    db.create_all()  # aqui crea todas las tablas
