from flask import jsonify, request
from app import app, db
from models.rol import *

# Ruta para crear un nuevo rol
@app.route('/roles', methods=['POST'])
def create_rol():
    data = request.get_json()
    descripcion = data.get('descripcion')

    nuevo_rol = Rol(descripcion=descripcion)
    db.session.add(nuevo_rol)
    db.session.commit()

    return jsonify({'message': 'Rol creado exitosamente'})

# Ruta para obtener todos los roles
@app.route('/roles', methods=['GET'])
def get_roles():
    roles = Rol.query.all()
    roles_serializados = []
    for rol in roles:
        rol_serializado = {
            'id': rol.id,
            'descripcion': rol.descripcion
        }
        roles_serializados.append(rol_serializado)

    return jsonify(roles_serializados)

# Ruta para obtener un rol por ID
@app.route('/roles/<int:rol_id>', methods=['GET'])
def get_rol(rol_id):
    rol = Rol.query.get(rol_id)
    if rol:
        rol_serializado = {
            'id': rol.id,
            'descripcion': rol.descripcion
        }
        return jsonify(rol_serializado)
    else:
        return jsonify({'message': 'Rol no encontrado'}), 404

# Ruta para actualizar un rol por ID
@app.route('/roles/<int:rol_id>', methods=['PUT'])
def update_rol(rol_id):
    rol = Rol.query.get(rol_id)
    if rol:
        data = request.get_json()
        descripcion = data.get('descripcion')

        rol.descripcion = descripcion
        db.session.commit()

        return jsonify({'message': 'Rol actualizado exitosamente'})
    else:
        return jsonify({'message': 'Rol no encontrado'}), 404

# Ruta para eliminar un rol por ID
@app.route('/roles/<int:rol_id>', methods=['DELETE'])
def delete_rol(rol_id):
    rol = Rol.query.get(rol_id)
    if rol:
        db.session.delete(rol)
        db.session.commit()
        return jsonify({'message': 'Rol eliminado exitosamente'})
    else:
        return jsonify({'message': 'Rol no encontrado'}), 404
