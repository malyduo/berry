/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', function () {
	const screen = document.getElementById('calculator-screen');
	const screenResult = document.getElementById('calculator-screen-result');
	const saveButton = document.getElementById('save-calculation');
	let currentNumber = '';
	let previousNumber = '';
	let operator = '';
	let isFinishedCalculation = false;

	const numbers = document.querySelectorAll('.number');
	const operators = document.querySelectorAll('.operator');
	const equalSign = document.getElementById('equal-sign');
	const clearButton = document.getElementById('clear');

	numbers.forEach(number => {
		number.addEventListener('click', function () {
			if(isFinishedCalculation) {
				clearButton.click();
				isFinishedCalculation = false;
			}

			currentNumber += this.dataset.number;
			if (screen.textContent.length < 2) {
				screen.textContent = currentNumber;
			} else {
				screen.textContent += currentNumber;
			}
		});
	});

	operators.forEach(op => {
		op.addEventListener('click', function () {
			if(!isFinishedCalculation) {
				operator = this.dataset.operator;
				screen.textContent += this.innerText;
				previousNumber = currentNumber;
				currentNumber = '';
			}
		});
	});

	equalSign.addEventListener('click', function () {
		let result;
		const prev = parseFloat(previousNumber);
		const current = parseFloat(currentNumber);

		if (isNaN(prev) || isNaN(current)) return;

		result = calculateExpression(screen.textContent);
		screenResult.textContent = result;
		currentNumber = '';
		operator = '';
		previousNumber = '';
		isFinishedCalculation = true;
	});

	clearButton.addEventListener('click', function () {
		currentNumber = '';
		previousNumber = '';
		operator = '';
		screen.textContent = '0';
		screenResult.textContent = '0';
	});

	function calculateExpression(expression) {
		expression = expression.replace(/\s+/g, '');

		let numbers = [];
		let operators = [];
		let i = 0;

		while (i < expression.length) {
			if (!isNaN(expression[i])) {
				let num = '';
				while (!isNaN(expression[i]) || expression[i] === '.') {
					num += expression[i];
					i++;
				}
				numbers.push(num);
			} else {
				if (expression[i] === 'x' || expression[i] === '/') {
					let operator = expression[i];
					i++;
					let num = '';
					while (!isNaN(expression[i]) || expression[i] === '.') {
						num += expression[i];
						i++;
					}
					let prevNum = numbers.pop();
					numbers.push(evaluate(operator, prevNum, num));
				} else {
					if (expression[i] === '+' || expression[i] === '-') {
						while (operators.length && (operators[operators.length - 1] === '+' || operators[operators.length - 1] === '-')) {
							let operator = operators.pop();
							let b = numbers.pop();
							let a = numbers.pop();
							numbers.push(evaluate(operator, a, b));
						}
						operators.push(expression[i]);
					}
					i++;
				}
			}
		}

		while (operators.length) {
			let operator = operators.pop();
			let b = numbers.pop();
			let a = numbers.pop();
			numbers.push(evaluate(operator, a, b));
		}

		return numbers[0];
	}

	function evaluate(operator, a, b) {
		a = parseFloat(a);
		b = parseFloat(b);
		switch (operator) {
			case '+': return a + b;
			case '-': return a - b;
			case 'x': return a * b;
			case '/': return a / b;
			default: return 0;
		}
	}

	saveButton.addEventListener('click', function () {
		const calculation = screen.textContent;
		const result = currentNumber;

		const data = new FormData();
		data.append('action', 'save_calculation');
		data.append('calculation', calculation);
		data.append('result', result);

		fetch(ajax_object.ajaxurl, {
			method: 'POST',
			body: data
		})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					alert('Calculation saved.');
				} else {
					alert('Failed to save calculation.');
				}
			})
			.catch(error => console.error('Error:', error));
	});
});
