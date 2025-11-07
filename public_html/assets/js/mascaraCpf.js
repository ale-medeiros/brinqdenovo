// assets/js/cpf-mask.js

function formatCPFValue(raw) {
  if (!raw) return '';
  let digits = raw.replace(/\D+/g, ''); // mantém só números
  digits = digits.slice(0, 11); // máximo 11 dígitos

  if (digits.length <= 3) return digits;
  if (digits.length <= 6) return digits.replace(/(\d{3})(\d+)/, "$1.$2");
  if (digits.length <= 9) return digits.replace(/(\d{3})(\d{3})(\d+)/, "$1.$2.$3");
  return digits.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
}

function applyCPFMask(input) {
  input.addEventListener('input', () => {
    input.value = formatCPFValue(input.value);
  });

  input.addEventListener('paste', () => {
    setTimeout(() => {
      input.value = formatCPFValue(input.value);
    }, 0);
  });

  input.addEventListener('blur', () => {
    input.value = formatCPFValue(input.value);
  });
}

/**
 * Função pública para aplicar máscara pelo id
 */
function initCPFMaskById(id) {
  const input = document.getElementById(id);
  if (input) {
    applyCPFMask(input);
  } else {
    console.warn(`Input com id "${id}" não encontrado.`);
  }
}

window.initCPFMaskById = initCPFMaskById;
