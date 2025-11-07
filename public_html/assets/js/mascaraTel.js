// assets/js/phone-mask.js

function formatPhoneValue(raw) {
  if (!raw) return '';
  let digits = raw.replace(/\D+/g, '');

  let country = '';
  if (digits.startsWith('55')) {
    country = '+55 ';
    digits = digits.slice(2);
  }

  digits = digits.slice(0, 11);

  if (digits.length === 0) return country.trim();

  const ddd = digits.slice(0, 2);
  const rest = digits.slice(2);

  if (digits.length <= 2) return `${country}(${ddd}`;

  if (rest.length <= 4) {
    return `${country}(${ddd}) ${rest}`;
  } else if (rest.length <= 8) {
    const part1 = rest.slice(0, 4);
    const part2 = rest.slice(4);
    return part2 ? `${country}(${ddd}) ${part1}-${part2}` : `${country}(${ddd}) ${part1}`;
  } else {
    const part1 = rest.slice(0, 5);
    const part2 = rest.slice(5, 9);
    return `${country}(${ddd}) ${part1}${part2 ? '-' + part2 : ''}`;
  }
}

function applyPhoneMask(input) {
  input.addEventListener('input', () => {
    input.value = formatPhoneValue(input.value);
  });

  input.addEventListener('paste', () => {
    setTimeout(() => {
      input.value = formatPhoneValue(input.value);
    }, 0);
  });

  input.addEventListener('blur', () => {
    input.value = formatPhoneValue(input.value);
  });
}

/**
 * Função pública para aplicar a máscara a um input pelo id
 */
function initPhoneMaskById(id) {
  const input = document.getElementById(id);
  if (input) {
    applyPhoneMask(input);
  } else {
    console.warn(`Input com id "${id}" não encontrado.`);
  }
}

// deixa global para ser chamado direto
window.initPhoneMaskById = initPhoneMaskById;
