from flask import Blueprint, jsonify, request
from models.user import User, user_schema, users_schema
from app import app, db
#user_bp = Blueprint('user', __name__)

# Obtener todos los usuarios
#@user_bp.route('/users', methods=['GET'])
@app.route('/users', methods=['GET'])
def get_users():
    all_users = User.query.all()
    result = users_schema.dump(all_users)
    return jsonify(result)

# Obtener un usuario por su ID
@app.route('/users/<id>', methods=['GET'])
def get_user(id):
    from routes.login_routes import login_schema  # Importación movida aquí para evitar conflicto circular
    user = User.query.get(id)
    return user_schema.jsonify(user)

# Crear un nuevo usuario
@app.route('/users', methods=['POST'])
def create_user():
    nombre = request.json['nombre']
    apellido = request.json['apellido']
    email = request.json['email']
    rol = request.json['rol']

    new_user = User(nombre, apellido, email, rol)
    db.session.add(new_user)
    db.session.commit()

    return user_schema.jsonify(new_user)

# Actualizar un usuario existente
@app.route('/users/<id>', methods=['PUT'])
def update_user(id):
    user = User.query.get(id)

    nombre = request.json['nombre']
    apellido = request.json['apellido']
    email = request.json['email']
    password = request.json['password']
    rol = request.json['rol']

    user.nombre = nombre
    user.apellido = apellido
    user.email = email
    user.password = password
    user.rol = rol

    db.session.commit()

    return user_schema.jsonify(user)

# Eliminar un usuario
@app.route('/users/<id>', methods=['DELETE'])
def delete_user(id):
    user = User.query.get(id)
    db.session.delete(user)
    db.session.commit()

    return user_schema.jsonify(user)
