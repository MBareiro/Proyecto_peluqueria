from flask import jsonify, request
from models.turno import Turno
from app import app, db

# Ruta para crear un nuevo turno
@app.route('/turnos', methods=['POST'])
def create_turno():
    data = request.get_json()
    fecha = data.get('fecha')
    hora = data.get('hora')
    cliente_id = data.get('cliente_id')
    peluquero_id = data.get('peluquero_id')
    servicio_id = data.get('servicio_id')

    nuevo_turno = Turno(fecha=fecha, hora=hora, cliente_id=cliente_id, peluquero_id=peluquero_id, servicio_id=servicio_id)
    db.session.add(nuevo_turno)
    db.session.commit()

    return jsonify({'message': 'Turno creado exitosamente'})

# Ruta para obtener todos los turnos
@app.route('/turnos', methods=['GET'])
def get_turnos():
    turnos = Turno.query.all()
    turnos_serializados = []
    for turno in turnos:
        turno_serializado = {
            'id': turno.id,
            'fecha': str(turno.fecha),
            'hora': str(turno.hora),
            'cliente_id': turno.cliente_id,
            'peluquero_id': turno.peluquero_id,
            'servicio_id': turno.servicio_id,
            'created_at': str(turno.created_at),
            'updated_at': str(turno.updated_at)
        }
        turnos_serializados.append(turno_serializado)

    return jsonify(turnos_serializados)

# Ruta para obtener un turno por ID
@app.route('/turnos/<int:turno_id>', methods=['GET'])
def get_turno(turno_id):
    turno = Turno.query.get(turno_id)
    if turno:
        turno_serializado = {
            'id': turno.id,
            'fecha': str(turno.fecha),
            'hora': str(turno.hora),
            'cliente_id': turno.cliente_id,
            'peluquero_id': turno.peluquero_id,
            'servicio_id': turno.servicio_id,
            'created_at': str(turno.created_at),
            'updated_at': str(turno.updated_at)
        }
        return jsonify(turno_serializado)
    else:
        return jsonify({'message': 'Turno no encontrado'}), 404

# Ruta para actualizar un turno por ID
@app.route('/turnos/<int:turno_id>', methods=['PUT'])
def update_turno(turno_id):
    turno = Turno.query.get(turno_id)
    if turno:
        data = request.get_json()
        fecha = data.get('fecha')
        hora = data.get('hora')
        cliente_id = data.get('cliente_id')
        peluquero_id = data.get('peluquero_id')
        servicio_id = data.get('servicio_id')

        turno.fecha = fecha
        turno.hora = hora
        turno.cliente_id = cliente_id
        turno.peluquero_id = peluquero_id
        turno.servicio_id = servicio_id
        db.session.commit()

        return jsonify({'message': 'Turno actualizado exitosamente'})
    else:
        return jsonify({'message': 'Turno no encontrado'}), 404

# Ruta para eliminar un turno por ID
@app.route('/turnos/<int:turno_id>', methods=['DELETE'])
def delete_turno(turno_id):
    turno = Turno.query.get(turno_id)
    if turno:
        db.session.delete(turno)
        db.session.commit()
        return jsonify({'message': 'Turno eliminado exitosamente'})
    else:
        return jsonify({'message': 'Turno no encontrado'}), 404
