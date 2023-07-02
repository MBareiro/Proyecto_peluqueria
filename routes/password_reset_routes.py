from flask import jsonify, request
from app import app, db
from models.password_reset import *
# Ruta para crear un nuevo registro de recuperación de contraseña
@app.route('/password_resets', methods=['POST'])
def create_password_reset():
    data = request.get_json()
    email = data.get('email')
    token = data.get('token')
    codigo = data.get('codigo')
    fecha = data.get('fecha')

    nuevo_reset = PasswordReset(email=email, token=token, codigo=codigo, fecha=fecha)
    db.session.add(nuevo_reset)
    db.session.commit()

    return jsonify({'message': 'Registro de recuperación de contraseña creado exitosamente'})

# Ruta para obtener todos los registros de recuperación de contraseña
@app.route('/password_resets', methods=['GET'])
def get_password_resets():
    password_resets = PasswordReset.query.all()
    password_resets_serializados = []
    for reset in password_resets:
        reset_serializado = {
            'id': reset.id,
            'email': reset.email,
            'token': reset.token,
            'codigo': reset.codigo,
            'fecha': str(reset.fecha)
        }
        password_resets_serializados.append(reset_serializado)

    return jsonify(password_resets_serializados)

# Ruta para obtener un registro de recuperación de contraseña por ID
@app.route('/password_resets/<int:reset_id>', methods=['GET'])
def get_password_reset(reset_id):
    reset = PasswordReset.query.get(reset_id)
    if reset:
        reset_serializado = {
            'id': reset.id,
            'email': reset.email,
            'token': reset.token,
            'codigo': reset.codigo,
            'fecha': str(reset.fecha)
        }
        return jsonify(reset_serializado)
    else:
        return jsonify({'message': 'Registro de recuperación de contraseña no encontrado'}), 404

# Ruta para eliminar un registro de recuperación de contraseña por ID
@app.route('/password_resets/<int:reset_id>', methods=['DELETE'])
def delete_password_reset(reset_id):
    reset = PasswordReset.query.get(reset_id)
    if reset:
        db.session.delete(reset)
        db.session.commit()
        return jsonify({'message': 'Registro de recuperación de contraseña eliminado exitosamente'})
    else:
        return jsonify({'message': 'Registro de recuperación de contraseña no encontrado'}), 404
