from flask import Flask, jsonify, request
from models.cliente import Cliente
from datetime import datetime
from app import app, db

# Ruta para obtener todos los clientes
@app.route('/clientes', methods=['GET'])
def get_clientes():
    clientes = Cliente.query.all()
    output = []
    for cliente in clientes:
        cliente_data = {
            'id': cliente.id,
            'nombre': cliente.nombre,
            'apellido': cliente.apellido,
            'email': cliente.email,
            'telefono': cliente.telefono,
            'created_at': cliente.created_at,
            'updated_at': cliente.updated_at
        }
        output.append(cliente_data)
    return jsonify({'clientes': output})

# Ruta para obtener un cliente por su ID
@app.route('/clientes/<int:cliente_id>', methods=['GET'])
def get_cliente(cliente_id):
    cliente = Cliente.query.get(cliente_id)
    if cliente:
        cliente_data = {
            'id': cliente.id,
            'nombre': cliente.nombre,
            'apellido': cliente.apellido,
            'email': cliente.email,
            'telefono': cliente.telefono,
            'created_at': cliente.created_at,
            'updated_at': cliente.updated_at
        }
        return jsonify(cliente_data)
    else:
        return jsonify({'message': 'Cliente no encontrado'}), 404

# Ruta para crear un nuevo cliente
@app.route('/clientes', methods=['POST'])
def create_cliente():
    data = request.get_json()
    nombre = data.get('nombre')
    apellido = data.get('apellido')
    email = data.get('email')
    telefono = data.get('telefono')

    nuevo_cliente = Cliente(nombre=nombre, apellido=apellido, email=email, telefono=telefono)
    db.session.add(nuevo_cliente)
    db.session.commit()

    return jsonify({'message': 'Cliente creado exitosamente'}), 201

# Ruta para actualizar un cliente existente
@app.route('/clientes/<int:cliente_id>', methods=['PUT'])
def update_cliente(cliente_id):
    cliente = Cliente.query.get(cliente_id)
    if cliente:
        data = request.get_json()
        cliente.nombre = data.get('nombre', cliente.nombre)
        cliente.apellido = data.get('apellido', cliente.apellido)
        cliente.email = data.get('email', cliente.email)
        cliente.telefono = data.get('telefono', cliente.telefono)
        cliente.updated_at = datetime.now()
        db.session.commit()
        return jsonify({'message': 'Cliente actualizado exitosamente'})
    else:
        return jsonify({'message': 'Cliente no encontrado'}), 404

# Ruta para eliminar un cliente existente
@app.route('/clientes/<int:cliente_id>', methods=['DELETE'])
def delete_cliente(cliente_id):
    cliente = Cliente.query.get(cliente_id)
    if cliente:
        db.session.delete(cliente)
        db.session.commit()
        return jsonify({'message': 'Cliente eliminado exitosamente'})
    else:
        return jsonify({'message': 'Cliente no encontrado'}), 404

