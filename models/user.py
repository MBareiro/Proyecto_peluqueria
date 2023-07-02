from app import db, app
from schemas.user_schema import *

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre = db.Column(db.String(255))
    apellido = db.Column(db.String(255))
    email = db.Column(db.String(255))
    email_verified_at = db.Column(db.DateTime)
    rol = db.Column(db.String(50))
    remember_token = db.Column(db.String(100))
    created_at = db.Column(db.DateTime)
    updated_at = db.Column(db.DateTime)
    login = db.relationship('Login', uselist=False, backref='user')
    #horarios = db.relationship('Horario', backref='user')

    def __init__(self, nombre, apellido, email, rol):
        self.nombre = nombre
        self.apellido = apellido
        self.email = email
        self.rol = rol
        
with app.app_context():
    db.create_all()