from flask import Blueprint, jsonify, request
from models.login import Login
from schemas.login_schema import login_schema, logins_schema
from app import app, db
#login_bp = Blueprint('login', __name__)

# Obtener todos los registros de login
#@login_bp.route('/login', methods=['GET'])
@app.route('/login', methods=['GET'])
def get_logins():
    all_logins = Login.query.all()
    result = logins_schema.dump(all_logins)
    return jsonify(result)

# Obtener un registro de login por su ID
@app.route('/login/<id>', methods=['GET'])
def get_login(id):
    from routes.user_routes import user_schema  # Importación movida aquí para evitar conflicto circular
    login = Login.query.get(id)
    return login_schema.jsonify(login)

# Crear un nuevo registro de login
@app.route('/login', methods=['POST'])
def create_login():
    username = request.json['username']
    password = request.json['password']
    user_id = request.json['user_id']

    new_login = Login(username, password, user_id)
    db.session.add(new_login)
    db.session.commit()

    return login_schema.jsonify(new_login)

# Actualizar un registro de login existente
@app.route('/login/<id>', methods=['PUT'])
def update_login(id):
    login = Login.query.get(id)

    username = request.json['username']
    password = request.json['password']

    login.username = username
    login.password = password

    db.session.commit()

    return login_schema.jsonify(login)

# Eliminar un registro de login
@app.route('/login/<id>', methods=['DELETE'])
def delete_login(id):
    login = Login.query.get(id)
    db.session.delete(login)
    db.session.commit()

    return login_schema.jsonify(login)
