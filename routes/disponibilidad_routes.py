from flask import jsonify, request
from app import app, db
from models.disponibilidad import *

# Ruta para crear una nueva disponibilidad
@app.route('/disponibilidades', methods=['POST'])
def create_disponibilidad():
    data = request.get_json()
    descripcion = data.get('descripcion')

    nueva_disponibilidad = Disponibilidad(descripcion=descripcion)
    db.session.add(nueva_disponibilidad)
    db.session.commit()

    return jsonify({'message': 'Disponibilidad creada exitosamente'})

# Ruta para obtener todas las disponibilidades
@app.route('/disponibilidades', methods=['GET'])
def get_disponibilidades():
    disponibilidades = Disponibilidad.query.all()
    disponibilidades_serializadas = []
    for disponibilidad in disponibilidades:
        disponibilidad_serializada = {
            'id': disponibilidad.id,
            'descripcion': disponibilidad.descripcion
        }
        disponibilidades_serializadas.append(disponibilidad_serializada)

    return jsonify(disponibilidades_serializadas)

# Ruta para obtener una disponibilidad por ID
@app.route('/disponibilidades/<int:disponibilidad_id>', methods=['GET'])
def get_disponibilidad(disponibilidad_id):
    disponibilidad = Disponibilidad.query.get(disponibilidad_id)
    if disponibilidad:
        disponibilidad_serializada = {
            'id': disponibilidad.id,
            'descripcion': disponibilidad.descripcion
        }
        return jsonify(disponibilidad_serializada)
    else:
        return jsonify({'message': 'Disponibilidad no encontrada'}), 404

# Ruta para actualizar una disponibilidad por ID
@app.route('/disponibilidades/<int:disponibilidad_id>', methods=['PUT'])
def update_disponibilidad(disponibilidad_id):
    disponibilidad = Disponibilidad.query.get(disponibilidad_id)
    if disponibilidad:
        data = request.get_json()
        descripcion = data.get('descripcion')

        disponibilidad.descripcion = descripcion
        db.session.commit()

        return jsonify({'message': 'Disponibilidad actualizada exitosamente'})
    else:
        return jsonify({'message': 'Disponibilidad no encontrada'}), 404

# Ruta para eliminar una disponibilidad por ID
@app.route('/disponibilidades/<int:disponibilidad_id>', methods=['DELETE'])
def delete_disponibilidad(disponibilidad_id):
    disponibilidad = Disponibilidad.query.get(disponibilidad_id)
    if disponibilidad:
        db.session.delete(disponibilidad)
        db.session.commit()
        return jsonify({'message': 'Disponibilidad eliminada exitosamente'})
    else:
        return jsonify({'message': 'Disponibilidad no encontrada'}), 404
