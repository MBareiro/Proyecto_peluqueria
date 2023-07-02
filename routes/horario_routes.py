from flask import jsonify, request
from app import app, db
from models.horario import *
# Ruta para crear un nuevo horario
@app.route('/horarios', methods=['POST'])
def create_horario():
    data = request.get_json()
    day = data.get('day')
    active_morning = data.get('active_morning')
    morning_start = data.get('morning_start')
    morning_end = data.get('morning_end')
    active_afternoon = data.get('active_afternoon')
    afternoon_start = data.get('afternoon_start')
    afternoon_end = data.get('afternoon_end')
    user_id = data.get('user_id')

    nuevo_horario = Horario(day=day, active_morning=active_morning, morning_start=morning_start, morning_end=morning_end,
                            active_afternoon=active_afternoon, afternoon_start=afternoon_start, afternoon_end=afternoon_end,
                            user_id=user_id)
    db.session.add(nuevo_horario)
    db.session.commit()

    return jsonify({'message': 'Horario creado exitosamente'})

# Ruta para obtener todos los horarios
@app.route('/horarios', methods=['GET'])
def get_horarios():
    horarios = Horario.query.all()
    horarios_serializados = []
    for horario in horarios:
        horario_serializado = {
            'id': horario.id,
            'day': horario.day,
            'active_morning': horario.active_morning,
            'morning_start': str(horario.morning_start),
            'morning_end': str(horario.morning_end),
            'active_afternoon': horario.active_afternoon,
            'afternoon_start': str(horario.afternoon_start),
            'afternoon_end': str(horario.afternoon_end),
            'user_id': horario.user_id
        }
        horarios_serializados.append(horario_serializado)

    return jsonify(horarios_serializados)

# Ruta para obtener un horario por ID
@app.route('/horarios/<int:horario_id>', methods=['GET'])
def get_horario(horario_id):
    horario = Horario.query.get(horario_id)
    if horario:
        horario_serializado = {
            'id': horario.id,
            'day': horario.day,
            'active_morning': horario.active_morning,
            'morning_start': str(horario.morning_start),
            'morning_end': str(horario.morning_end),
            'active_afternoon': horario.active_afternoon,
            'afternoon_start': str(horario.afternoon_start),
            'afternoon_end': str(horario.afternoon_end),
            'user_id': horario.user_id
        }
        return jsonify(horario_serializado)
    else:
        return jsonify({'message': 'Horario no encontrado'}), 404

# Ruta para actualizar un horario por ID
@app.route('/horarios/<int:horario_id>', methods=['PUT'])
def update_horario(horario_id):
    horario = Horario.query.get(horario_id)
    if horario:
        data = request.get_json()
        day = data.get('day')
        active_morning = data.get('active_morning')
        morning_start = data.get('morning_start')
        morning_end = data.get('morning_end')
        active_afternoon = data.get('active_afternoon')
        afternoon_start = data.get('afternoon_start')
        afternoon_end = data.get('afternoon_end')
        user_id = data.get('user_id')

        horario.day = day
        horario.active_morning = active_morning
        horario.morning_start = morning_start
        horario.morning_end = morning_end
        horario.active_afternoon = active_afternoon
        horario.afternoon_start = afternoon_start
        horario.afternoon_end = afternoon_end
        horario.user_id = user_id

        db.session.commit()

        return jsonify({'message': 'Horario actualizado exitosamente'})
    else:
        return jsonify({'message': 'Horario no encontrado'}), 404

# Ruta para eliminar un horario por ID
@app.route('/horarios/<int:horario_id>', methods=['DELETE'])
def delete_horario(horario_id):
    horario = Horario.query.get(horario_id)
    if horario:
        db.session.delete(horario)
        db.session.commit()
        return jsonify({'message': 'Horario eliminado exitosamente'})
    else:
        return jsonify({'message': 'Horario no encontrado'}), 404
