// scheduling.js - JavaScript para a página de Registrar Avaliações

document.addEventListener('DOMContentLoaded', function() {
    // Inicialização quando a página carrega
    initializeSchedulingForm();
});

function initializeSchedulingForm() {
    console.log('Formulário de agendamento inicializado');
    
    // Adicionar validações customizadas no futuro
    const form = document.getElementById('scheduling-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateSchedulingForm()) {
                e.preventDefault();
            }
        });
    }
}

function validateSchedulingForm() {
    // Implementar validações customizadas aqui no futuro
    const discipline = document.getElementById('discipline_id').value;
    const date = document.getElementById('date').value;
    
    if (!discipline || !date) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return false;
    }
    
    return true;
}

function clearForm() {
    const form = document.querySelector('#scheduling-form');
    if (form) {
        form.reset();
    }
}

// Função para formatar data (para uso futuro)
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-BR');
}

// Função para validar horário (para uso futuro)
function validateTime(timeString) {
    const timeRegex = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
    return timeRegex.test(timeString);
}