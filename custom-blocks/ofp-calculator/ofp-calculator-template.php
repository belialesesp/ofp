<?php
// Get ACF field values
$background_type = get_field('background_type');
$background_image = get_field('background_image');
$rotation_deg = get_field('rotation_deg');
$background_color_start = get_field('background_color_start');
$background_color_end = get_field('background_color_end');
$background_color = get_field('background_color');
$accent_color = get_field('accent_color') ?: '#6496c8';

$title = get_field('title') ?: 'Points Calculator';
$description = get_field('description') ?: 'What are my points worth? Based on this calculator, you can see if a points redemption is the best way to go!';
$show_logo = get_field('show_logo');
$custom_logo = get_field('custom_logo');

$blockID = 'ofp-calculator-' . uniqid();

// Set logo URL - either custom or default site logo
$logo_url = '';
if ($show_logo) {
    if (!empty($custom_logo) && is_array($custom_logo)) {
        $logo_url = esc_url($custom_logo['url']);
    } else {
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
        }
    }
}
?>

<!-- Calculator Styles -->
<style>
/* Base Variables */
#<?php echo $blockID; ?> {
    --primary-color: #132b43;
    --secondary-color: #91b9dc;
    --accent-color: <?php echo $accent_color; ?>;
    --light-bg: <?php echo ($background_type == 'color') ? $background_color : '#f8f9fa'; ?>;
    --text-color: #333;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

<?php if ($background_type == 'gradient'): ?>
#<?php echo $blockID; ?> {
    background: linear-gradient(
        <?php echo $rotation_deg ? $rotation_deg : 90 ?>deg,
        <?php echo $background_color_start; ?> 0%,
        <?php echo $background_color_end; ?> 100%
    );
}
<?php endif; ?>

<?php if ($background_type == 'image' && is_array($background_image)): ?>
#<?php echo $blockID; ?> {
    background-image: url(<?php echo esc_url($background_image['url']); ?>);
    background-size: cover;
    background-position: center;
}
<?php endif; ?>

<?php if ($background_type == 'color'): ?>
#<?php echo $blockID; ?> {
    background-color: <?php echo $background_color; ?>;
}
<?php endif; ?>

/* Calculator Specific Styles */
#<?php echo $blockID; ?> {
    padding: 30px 0;
    margin: 25px 0;
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

#<?php echo $blockID; ?> .logo-image {
    max-width: 250px;
    height: auto;
    margin-bottom: 15px;
    display: inline-block;
    transition: transform 0.3s ease;
}

#<?php echo $blockID; ?> .calculator-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 15px;
}

#<?php echo $blockID; ?> h1 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 0.5rem;
    font-family: inherit;
}

#<?php echo $blockID; ?> .lead {
    color: #555;
    font-size: 1.1rem;
    max-width: 800px;
    margin: 0 auto 1.5rem;
    line-height: 1.5;
}

#<?php echo $blockID; ?> .calculator-body {
    background-color: #fff;
    box-shadow: var(--box-shadow);
    border: none;
    margin-top: 20px;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}

#<?php echo $blockID; ?> .card-body {
    padding: 25px;
}

#<?php echo $blockID; ?> .section-heading {
    border-bottom: 1px solid #eee;
    padding-bottom: 0.75rem;
    margin-bottom: 1.25rem;
}

#<?php echo $blockID; ?> .section-heading h2 {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 1.25rem;
    margin-bottom: 0;
    font-family: inherit;
}

#<?php echo $blockID; ?> .form-label {
    font-weight: 500;
    color: #444;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

#<?php echo $blockID; ?> .form-control,
#<?php echo $blockID; ?> .form-select {
    padding: 0.75rem;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

#<?php echo $blockID; ?> .form-control:focus,
#<?php echo $blockID; ?> .form-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.2rem rgba(100, 150, 200, 0.25);
    outline: none;
}

#<?php echo $blockID; ?> .input-group-text {
    background-color: #f8f9fa;
    font-weight: 500;
    border-color: #ccc;
}

#<?php echo $blockID; ?> .btn-primary {
    background-color: var(--accent-color);
    border-color: var(--accent-color);
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

#<?php echo $blockID; ?> .btn-primary:hover {
    background-color: #9BBFCD;
    border-color: #9BBFCD;
    transform: translateY(-1px);
}

#<?php echo $blockID; ?> .btn-primary:active {
    transform: translateY(1px);
}

#<?php echo $blockID; ?> .btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
    border-radius: 6px;
    padding: 0.75rem 1.5rem;
    transition: all 0.2s ease;
}

#<?php echo $blockID; ?> .btn-outline-secondary:hover {
    background-color: #f8f9fa;
    color: #5a6268;
}

#<?php echo $blockID; ?> .invalid-feedback {
    font-size: 0.85rem;
    margin-top: 0.3rem;
}

#<?php echo $blockID; ?> .results-section {
    transition: all 0.3s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#<?php echo $blockID; ?> .results-section:not(.d-none) {
    display: block !important;
    animation: fadeInUp 0.4s ease-out forwards;
}

#<?php echo $blockID; ?> .alert {
    border-radius: var(--border-radius);
    padding: 1rem 1.25rem;
}

#<?php echo $blockID; ?> .alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

#<?php echo $blockID; ?> .alert-warning {
    background-color: #fff3cd;
    border-color: #ffeeba;
    color: #856404;
}

#<?php echo $blockID; ?> .alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

#<?php echo $blockID; ?> .alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

#<?php echo $blockID; ?> .card-header {
    background-color: #f8f9fa;
    font-weight: 500;
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
}

#<?php echo $blockID; ?> .table {
    margin-bottom: 0;
}

#<?php echo $blockID; ?> .table td {
    padding: 0.75rem 1.25rem;
    border-color: #eee;
    font-size: 0.95rem;
}

#<?php echo $blockID; ?> .text-end {
    font-weight: 500;
    text-align: right;
}

#<?php echo $blockID; ?> .help-text {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 0.25rem;
}

#<?php echo $blockID; ?> .mb-1 {
    margin-bottom: 0.25rem !important;
}

#<?php echo $blockID; ?> .mb-2 {
    margin-bottom: 0.5rem !important;
}

#<?php echo $blockID; ?> .mb-3 {
    margin-bottom: 1rem !important;
}

#<?php echo $blockID; ?> .mb-4 {
    margin-bottom: 1.5rem !important;
}

#<?php echo $blockID; ?> .mt-3 {
    margin-top: 1rem !important;
}

#<?php echo $blockID; ?> .mt-4 {
    margin-top: 1.5rem !important;
}

#<?php echo $blockID; ?> .d-flex {
    display: flex;
}

#<?php echo $blockID; ?> .justify-content-between {
    justify-content: space-between;
}

#<?php echo $blockID; ?> .row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

#<?php echo $blockID; ?> .col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding-right: 15px;
    padding-left: 15px;
    position: relative;
    width: 100%;
}

#<?php echo $blockID; ?> .text-center {
    text-align: center;
}

#<?php echo $blockID; ?> .btn-lg {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: 0.3rem;
}

#<?php echo $blockID; ?> .px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}

#<?php echo $blockID; ?> .d-none {
    display: none !important;
}

#<?php echo $blockID; ?> .input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

#<?php echo $blockID; ?> .input-group-text {
    display: flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

#<?php echo $blockID; ?> .form-control:first-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

#<?php echo $blockID; ?> .input-group > :not(:first-child):not(.dropdown-menu) {
    margin-left: -1px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

#<?php echo $blockID; ?> .program-warning {
    background-color: #f0f8ff;
    border: 1px solid #b8daff;
    padding: 0.75rem;
    border-radius: 4px;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #004085;
}

/* Media Queries for Responsive Design */
@media (max-width: 768px) {
    #<?php echo $blockID; ?> .calculator-container {
        padding: 10px;
    }

    #<?php echo $blockID; ?> .card-body {
        padding: 20px 15px;
    }

    #<?php echo $blockID; ?> h1 {
        font-size: 1.75rem;
    }

    #<?php echo $blockID; ?> .lead {
        font-size: 1rem;
    }
    
    #<?php echo $blockID; ?> .btn-primary,
    #<?php echo $blockID; ?> .btn-outline-secondary {
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
    }
    
    #<?php echo $blockID; ?> .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>

<!-- Points Calculator -->
<div id="<?php echo $blockID; ?>">
    <div class="calculator-container">
        <?php if ($show_logo && !empty($logo_url)): ?>
        <div class="text-center mb-3">
            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo" class="logo-image" width="250">
        </div>
        <?php endif; ?>
        
        <header class="text-center mb-4">
            <h1><?php echo esc_html($title); ?></h1>
            <p class="lead"><?php echo esc_html($description); ?></p>
        </header>

        <div class="calculator-body card">
            <div class="card-body">
                <form id="calculator-form-<?php echo $blockID; ?>">
                    <div class="section-heading mb-3">
                        <h2 class="h4">Awards Redemption</h2>
                    </div>

                    <!-- Program Selection -->
                    <div class="mb-3">
                        <label for="loyalty-program-<?php echo $blockID; ?>" class="form-label">Points Type</label>
                        <select class="form-select" id="loyalty-program-<?php echo $blockID; ?>">
                            <option value="" selected>Choose a program</option>
                            <optgroup label="Airlines">
                                <option value="air_canada">Air Canada Aeroplan</option>
                                <option value="alaska">Alaska Mileage Plan</option>
                                <option value="american">American Airlines AAdvantage</option>
                                <option value="british">British Airways Avios</option>
                                <option value="delta">Delta SkyMiles</option>
                                <option value="flying_blue">Flying Blue (Air France/KLM)</option>
                                <option value="jetblue">JetBlue TrueBlue</option>
                                <option value="singapore">Singapore Airlines KrisFlyer</option>
                                <option value="southwest">Southwest Rapid Rewards</option>
                                <option value="united">United MileagePlus</option>
                                <option value="virgin">Virgin Atlantic Flying Club</option>
                            </optgroup>
                            <optgroup label="Hotels">
                                <option value="hilton">Hilton Honors</option>
                                <option value="hyatt">World of Hyatt</option>
                                <option value="ihg">IHG One Rewards</option>
                                <option value="marriott">Marriott Bonvoy</option>
                            </optgroup>
                            <option value="other">Other</option>
                        </select>
                        <div class="help-text">Select your loyalty program to get program-specific value assessments</div>
                    </div>

                    <div class="row mb-4">
                        <!-- Points Input -->
                        <div class="col-md-6">
                            <label for="points-required-<?php echo $blockID; ?>" class="form-label">Cost in points or miles</label>
                            <input type="text" class="form-control" id="points-required-<?php echo $blockID; ?>" placeholder="115000" min="0">
                            <div class="help-text">Enter without commas</div>
                            <div class="invalid-feedback">Please enter a valid number of points.</div>
                        </div>
                        
                        <!-- Fees Input -->
                        <div class="col-md-6">
                            <label for="fees-<?php echo $blockID; ?>" class="form-label">Fees (if any)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="fees-<?php echo $blockID; ?>" placeholder="0" min="0" step="0.01">
                            </div>
                            <div class="help-text">Taxes and fees when booking with points</div>
                            <div class="invalid-feedback">Please enter a valid fee amount.</div>
                        </div>
                    </div>

                    <div class="section-heading mb-3">
                        <h2 class="h4">Paying Cash</h2>
                    </div>

                    <!-- Cash Price Input -->
                    <div class="mb-4">
                        <label for="cash-price-<?php echo $blockID; ?>" class="form-label">Cost</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="cash-price-<?php echo $blockID; ?>" placeholder="500.00" min="0" step="0.01">
                        </div>
                        <div class="help-text">Total cash price including taxes and fees</div>
                        <div class="invalid-feedback">Please enter a valid cash price.</div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <button type="button" id="calculate-btn-<?php echo $blockID; ?>" class="btn btn-primary btn-lg px-4">Calculate</button>
                        <button type="button" id="reset-btn-<?php echo $blockID; ?>" class="btn btn-outline-secondary">Start over</button>
                    </div>
                </form>

                <!-- Results Section (initially hidden) -->
                <div id="results-section-<?php echo $blockID; ?>" class="mt-4 d-none results-section">
                    <div class="alert" id="result-alert-<?php echo $blockID; ?>" role="alert">
                        <h3 class="h5" id="result-heading-<?php echo $blockID; ?>"></h3>
                        <p id="result-value-<?php echo $blockID; ?>" class="mb-1"></p>
                        <p id="result-explanation-<?php echo $blockID; ?>" class="mb-0"></p>
                    </div>
                    
                    <div class="card mt-3">
                        <div class="card-header">Value breakdown</div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Cash price:</td>
                                        <td class="text-end" id="breakdown-cash-<?php echo $blockID; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Points/miles required:</td>
                                        <td class="text-end" id="breakdown-points-<?php echo $blockID; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Fees when using points:</td>
                                        <td class="text-end" id="breakdown-fees-<?php echo $blockID; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Net savings when using points:</td>
                                        <td class="text-end" id="breakdown-savings-<?php echo $blockID; ?>"></td>
                                    </tr>
                                    <tr style="font-weight: bold;">
                                        <td>Value per point:</td>
                                        <td class="text-end" id="breakdown-value-<?php echo $blockID; ?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="program-note-<?php echo $blockID; ?>" class="program-warning mt-3 d-none">
                        <strong>Note:</strong> <span id="program-note-text-<?php echo $blockID; ?>"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calculator JavaScript -->
<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const blockID = '<?php echo $blockID; ?>';
        
        // Get DOM elements
        const calculatorForm = document.getElementById('calculator-form-' + blockID);
        const calculateBtn = document.getElementById('calculate-btn-' + blockID);
        const resetBtn = document.getElementById('reset-btn-' + blockID);
        const resultsSection = document.getElementById('results-section-' + blockID);
        
        const pointsInput = document.getElementById('points-required-' + blockID);
        const feesInput = document.getElementById('fees-' + blockID);
        const cashPriceInput = document.getElementById('cash-price-' + blockID);
        const loyaltyProgramSelect = document.getElementById('loyalty-program-' + blockID);
        
        const resultAlert = document.getElementById('result-alert-' + blockID);
        const resultHeading = document.getElementById('result-heading-' + blockID);
        const resultValue = document.getElementById('result-value-' + blockID);
        const resultExplanation = document.getElementById('result-explanation-' + blockID);
        
        const breakdownCash = document.getElementById('breakdown-cash-' + blockID);
        const breakdownPoints = document.getElementById('breakdown-points-' + blockID);
        const breakdownFees = document.getElementById('breakdown-fees-' + blockID);
        const breakdownSavings = document.getElementById('breakdown-savings-' + blockID);
        const breakdownValue = document.getElementById('breakdown-value-' + blockID);
        
        // Define program-specific value thresholds (in cents per point)
        const programThresholds = {
            american: { poor: 1.0, good: 1.5, excellent: 2.0 },
            united: { poor: 1.0, good: 1.5, excellent: 1.8 },
            delta: { poor: 0.8, good: 1.2, excellent: 1.5 },
            southwest: { poor: 1.2, good: 1.5, excellent: 1.7 },
            jetblue: { poor: 1.0, good: 1.3, excellent: 1.6 },
            alaska: { poor: 1.2, good: 1.7, excellent: 2.0 },
            british: { poor: 1.0, good: 1.3, excellent: 1.6 },
            air_canada: { poor: 1.0, good: 1.5, excellent: 1.8 },
            flying_blue: { poor: 1.0, good: 1.4, excellent: 1.8 },
            singapore: { poor: 1.2, good: 1.5, excellent: 2.0 },
            virgin: { poor: 1.0, good: 1.4, excellent: 1.8 },
            marriott: { poor: 0.5, good: 0.7, excellent: 0.9 },
            hilton: { poor: 0.3, good: 0.5, excellent: 0.6 },
            hyatt: { poor: 1.2, good: 1.7, excellent: 2.2 },
            ihg: { poor: 0.4, good: 0.6, excellent: 0.8 },
            other: { poor: 1.0, good: 1.5, excellent: 2.0 }
        };
        
        // Format numbers for display
        function formatNumber(number) {
            return number.toLocaleString();
        }
        
        // Format currency for display
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        }
        
        // Clean number input
        function cleanNumberInput(value) {
            if (!value) return 0;
            return parseFloat(value.toString().replace(/[^0-9.-]/g, ''));
        }
        
        // Calculate value per point
        function calculateValue(cashPrice, pointsRequired, fees) {
            if (pointsRequired <= 0) return { valueInCents: 0, netSavings: 0 };
            
            // Net savings = Cash price - Fees
            const netSavings = cashPrice - fees;
            
            // Value per point in cents
            const valueInCents = (netSavings / pointsRequired) * 100;
            
            return {
                valueInCents: valueInCents,
                netSavings: netSavings
            };
        }
        
        // Evaluate if the deal is good
        function evaluateDeal(valuePerPoint, program) {
            const thresholds = programThresholds[program] || programThresholds.other;
            
            if (valuePerPoint >= thresholds.excellent) {
                return {
                    status: 'excellent',
                    message: 'This is an excellent redemption value! You should definitely book with points.',
                    alertClass: 'alert-success',
                    heading: 'Excellent Value!'
                };
            } else if (valuePerPoint >= thresholds.good) {
                return {
                    status: 'good',
                    message: 'This is a good redemption value. Using points is recommended.',
                    alertClass: 'alert-success',
                    heading: 'Good Value'
                };
            } else if (valuePerPoint >= thresholds.poor) {
                return {
                    status: 'fair',
                    message: 'This is a fair redemption value. Consider your options.',
                    alertClass: 'alert-warning',
                    heading: 'Fair Value'
                };
            } else {
                return {
                    status: 'poor',
                    message: 'This is below average redemption value. Consider paying with cash.',
                    alertClass: 'alert-danger',
                    heading: 'Poor Value'
                };
            }
        }
        
        // Validate form inputs
        function validateInputs() {
            let isValid = true;
            
            // Validate points
            const pointsValue = cleanNumberInput(pointsInput.value);
            if (!pointsInput.value || pointsValue <= 0) {
                pointsInput.classList.add('is-invalid');
                isValid = false;
            } else {
                pointsInput.classList.remove('is-invalid');
            }
            
            // Validate fees
            const feesValue = cleanNumberInput(feesInput.value);
            if (feesInput.value && feesValue < 0) {
                feesInput.classList.add('is-invalid');
                isValid = false;
            } else {
                feesInput.classList.remove('is-invalid');
            }
            
            // Validate cash price
            const cashValue = cleanNumberInput(cashPriceInput.value);
            if (!cashPriceInput.value || cashValue <= 0) {
                cashPriceInput.classList.add('is-invalid');
                isValid = false;
            } else {
                cashPriceInput.classList.remove('is-invalid');
            }
            
            return isValid;
        }
        
        // Calculate and display results
        function performCalculation() {
            if (!validateInputs()) {
                return;
            }
            
            // Get input values
            const pointsRequired = cleanNumberInput(pointsInput.value);
            const fees = cleanNumberInput(feesInput.value || 0);
            const cashPrice = cleanNumberInput(cashPriceInput.value);
            const program = loyaltyProgramSelect.value || 'other';
            
            // Calculate value per point and net savings
            const calculation = calculateValue(cashPrice, pointsRequired, fees);
            const valuePerPoint = calculation.valueInCents;
            const netSavings = calculation.netSavings;
            
            // Evaluate the deal
            const evaluation = evaluateDeal(valuePerPoint, program);
            
            // Update the result display
            resultAlert.className = 'alert ' + evaluation.alertClass;
            resultHeading.textContent = evaluation.heading;
            resultValue.textContent = 'Value per point: ' + valuePerPoint.toFixed(2) + ' cents';
            resultExplanation.textContent = evaluation.message;
            
            // Update breakdown
            breakdownCash.textContent = formatCurrency(cashPrice);
            breakdownPoints.textContent = formatNumber(pointsRequired);
            breakdownFees.textContent = formatCurrency(fees);
            breakdownSavings.textContent = formatCurrency(netSavings);
            breakdownValue.textContent = valuePerPoint.toFixed(2) + ' cents per point';
            
            // Show results section
            resultsSection.classList.remove('d-none');
            
            // Scroll to results
            setTimeout(function() {
                resultsSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }
        
        // Reset the calculator
        function resetCalculator() {
            if (calculatorForm) {
                calculatorForm.reset();
            }
            
            if (resultsSection) {
                resultsSection.classList.add('d-none');
            }
            
            // Remove validation classes
            if (pointsInput) {
                pointsInput.classList.remove('is-invalid');
            }
            
            if (feesInput) {
                feesInput.classList.remove('is-invalid');
            }
            
            if (cashPriceInput) {
                cashPriceInput.classList.remove('is-invalid');
            }
        }
        
        // Event listeners
        if (calculateBtn) {
            calculateBtn.addEventListener('click', performCalculation);
        }
        
        if (resetBtn) {
            resetBtn.addEventListener('click', resetCalculator);
        }
        
        // Format inputs as they are entered
        if (pointsInput) {
            pointsInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }
        
        if (cashPriceInput) {
            cashPriceInput.addEventListener('input', function() {
                let value = this.value.replace(/[^0-9.]/g, '');
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                this.value = value;
            });
        }
        
        if (feesInput) {
            feesInput.addEventListener('input', function() {
                let value = this.value.replace(/[^0-9.]/g, '');
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                this.value = value;
            });
        }
        
        // Allow Enter key to calculate
        if (calculatorForm) {
            calculatorForm.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performCalculation();
                }
            });
        }
    });
})();
</script>