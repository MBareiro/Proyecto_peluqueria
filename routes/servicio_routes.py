from flask import jsonify, request
from app import app, db
from models.servicio import *

# Ruta para crear un nuevo servicio
@app.route('/servicios', methods=['POST'])
def create_servicio():
    data = request.get_json()
    descripcion = data.get('descripcion')
    precio = data.get('precio')
    duracion = data.get('duracion')

    nuevo_servicio = Servicio(descripcion=descripcion, precio=precio, duracion=duracion)
    db.session.add(nuevo_servicio)
    db.session.commit()

    return jsonify({'message': 'Servicio creado exitosamente'})

# Ruta para obtener todos los servicios
@app.route('/servicios', methods=['GET'])
def get_servicios():
    servicios = Servicio.query.all()
    servicios_serializados = []
    for servicio in servicios:
        servicio_serializado = {
            'id': servicio.id,
            'descripcion': servicio.descripcion,
            'precio': servicio.precio,
            'duracion': servicio.duracion,
            'created_at': str(servicio.created_at),
            'updated_at': str(servicio.updated_at)
        }
        servicios_serializados.append(servicio_serializado)

    return jsonify(servicios_serializados)

# Ruta para obtener un servicio por ID
@app.route('/servicios/<int:servicio_id>', methods=['GET'])
def get_servicio(servicio_id):
    servicio = Servicio.query.get(servicio_id)
    if servicio:
        servicio_serializado = {
            'id': servicio.id,
            'descripcion': servicio.descripcion,
            'precio': servicio.precio,
            'duracion': servicio.duracion,
            'created_at': str(servicio.created_at),
            'updated_at': str(servicio.updated_at)
        }
        return jsonify(servicio_serializado)
    else:
        return jsonify({'message': 'Servicio no encontrado'}), 404

# Ruta para actualizar un servicio por ID
@app.route('/servicios/<int:servicio_id>', methods=['PUT'])
def update_servicio(servicio_id):
    servicio = Servicio.query.get(servicio_id)
    if servicio:
        data = request.get_json()
        descripcion = data.get('descripcion')
        precio = data.get('precio')
        duracion = data.get('duracion')

        servicio.descripcion = descripcion
        servicio.precio = precio
        servicio.duracion = duracion
        db.session.commit()

        return jsonify({'message': 'Servicio actualizado exitosamente'})
    else:
        return jsonify({'message': 'Servicio no encontrado'}), 404

# Ruta para eliminar un servicio por ID
@app.route('/servicios/<int:servicio_id>', methods=['DELETE'])
def delete_servicio(servicio_id):
    servicio = Servicio.query.get(servicio_id)
    if servicio:
        db.session.delete(servicio)
        db.session.commit()
        return jsonify({'message': 'Servicio eliminado exitosamente'})
    else:
        return jsonify({'message': 'Servicio no encontrado'}), 404
