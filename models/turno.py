from app import db, app

# Modelo para la tabla Turnos
class Turno(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    fecha = db.Column(db.Date)
    hora = db.Column(db.Time)
    cliente_id = db.Column(db.Integer, db.ForeignKey('cliente.id'))
    peluquero_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    servicio_id = db.Column(db.Integer, db.ForeignKey('servicio.id'))
    created_at = db.Column(db.DateTime)
    updated_at = db.Column(db.DateTime)

    def __init__(self, fecha, hora, cliente_id, peluquero_id, servicio_id):
        self.fecha = fecha
        self.hora = hora
        self.cliente_id = cliente_id
        self.peluquero_id = peluquero_id
        self.servicio_id = servicio_id
        
with app.app_context():
    db.create_all()  # aqui crea todas las tablas
