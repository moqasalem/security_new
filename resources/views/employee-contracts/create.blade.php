@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/employee-contracts-create.css') }}">
@endpush



@section('content')
<div class="emp-contract-create-page">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-header__left">
            <h1 class="page-title">إنشاء عقد موظف</h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('dashboard') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('employee-contracts') }}">عقود الموظفين</a>
                <span>/</span>
                <span>إنشاء</span>
            </nav>
        </div>
        <div class="page-header__right">
            <a href="{{ route('employee-contracts') }}" class="btn btn--outline" id="btnBackToEmployeeContracts">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
                رجوع
            </a>
            <button class="btn btn--outline" id="btnSaveDraft">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"/></svg>
                حفظ كمسودة
            </button>
            <button class="btn btn--primary" id="btnGenerateContract">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd"/></svg>
                توليد العقد
            </button>
            <button class="btn btn--outline" id="btnPreviewPdf" disabled>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                معاينة PDF
            </button>
            <button class="btn btn--primary" id="btnSendContract" disabled>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                إرسال للموظف
            </button>
            <button class="btn btn--outline" id="btnDownloadPdf" disabled>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                تنزيل PDF
            </button>
            <button class="btn btn--text" id="btnResetForm">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg>
                إعادة ضبط
            </button>
        </div>
    </div>

    {{-- Status Banner --}}
    <div class="status-banner status-banner--draft" id="statusBanner">
        <div class="status-banner__icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
        </div>
        <div class="status-banner__text">
            <strong id="bannerTitle">مسودة</strong>
            <span id="bannerSubtext">أكمل البيانات ثم اضغط "توليد العقد"</span>
        </div>
    </div>

    {{-- Main Layout --}}
    <div class="create-layout">
        {{-- Main Column: Form --}}
        <div class="create-layout__main">

            {{-- Section A: Basic Info --}}
            <div class="form-card">
                <div class="form-card__header">
                    <h2 class="form-card__title">البيانات الأساسية</h2>
                    <span class="section-badge">1</span>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="empName">الاسم الكامل <span class="req">*</span></label>
                        <input type="text" id="empName" class="form-input" placeholder="مثال: عبدالله محمد الحربي" required>
                        <span class="form-error" id="errName"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empIdNumber">رقم الهوية/الإقامة <span class="req">*</span></label>
                        <input type="text" id="empIdNumber" class="form-input" placeholder="10 أرقام" maxlength="10" required>
                        <span class="form-error" id="errIdNumber"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empPhone">رقم الجوال <span class="req">*</span></label>
                        <input type="text" id="empPhone" class="form-input" placeholder="05XXXXXXXX" maxlength="10" required>
                        <span class="form-error" id="errPhone"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empEmail">البريد الإلكتروني</label>
                        <input type="email" id="empEmail" class="form-input" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empNationality">الجنسية</label>
                        <input type="text" id="empNationality" class="form-input" placeholder="مثال: سعودي">
                    </div>
                </div>
            </div>

            {{-- Section B: Job Info --}}
            <div class="form-card">
                <div class="form-card__header">
                    <h2 class="form-card__title">بيانات الوظيفة</h2>
                    <span class="section-badge">2</span>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="empTitle">المسمى الوظيفي <span class="req">*</span></label>
                        <select id="empTitle" class="form-select" required>
                            <option value="حارس أمن">حارس أمن</option>
                            <option value="مشرف أمني">مشرف أمني</option>
                            <option value="ضابط أمن">ضابط أمن</option>
                            <option value="فني مراقبة">فني مراقبة</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empSalary">الراتب (ر.س) <span class="req">*</span></label>
                        <input type="number" id="empSalary" class="form-input" value="4500" min="0" required>
                        <span class="form-error" id="errSalary"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empAllowances">البدلات (ر.س)</label>
                        <input type="number" id="empAllowances" class="form-input" value="0" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empSite">موقع العمل <span class="req">*</span></label>
                        <select id="empSite" class="form-select" required>
                            <option value="">اختر الموقع</option>
                        </select>
                        <span class="form-error" id="errSite"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empBranch">الفرع <span class="req">*</span></label>
                        <select id="empBranch" class="form-select" required>
                            <option value="">اختر الفرع</option>
                        </select>
                        <span class="form-error" id="errBranch"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="empShift">ساعات العمل/النوبة</label>
                        <input type="text" id="empShift" class="form-input" placeholder="مثال: 8 ساعات - وردية صباحية">
                    </div>
                </div>
            </div>

            {{-- Section C: Contract Info --}}
            <div class="form-card">
                <div class="form-card__header">
                    <h2 class="form-card__title">بيانات العقد</h2>
                    <span class="section-badge">3</span>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="contractStartDate">تاريخ بداية العقد <span class="req">*</span></label>
                        <input type="date" id="contractStartDate" class="form-input" required>
                        <span class="form-error" id="errStartDate"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contractDuration">مدة العقد (بالأشهر) <span class="req">*</span></label>
                        <select id="contractDuration" class="form-select" required>
                            <option value="">اختر المدة</option>
                            <option value="3">3 أشهر</option>
                            <option value="6">6 أشهر</option>
                            <option value="12" selected>12 شهر</option>
                            <option value="24">24 شهر</option>
                        </select>
                        <span class="form-error" id="errDuration"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contractEndDate">تاريخ نهاية العقد</label>
                        <input type="date" id="contractEndDate" class="form-input" readonly>
                        <span class="form-hint">يُحسب تلقائياً</span>
                    </div>
                    <div class="form-group form-group--full">
                        <div class="toggle-row">
                            <label class="form-label" for="trialToggle">فترة تجربة</label>
                            <label class="toggle">
                                <input type="checkbox" id="trialToggle">
                                <span class="toggle__slider"></span>
                            </label>
                        </div>
                        <div id="trialDaysGroup" class="form-subgroup" style="display:none;">
                            <label class="form-label" for="trialDays">عدد أيام التجربة</label>
                            <input type="number" id="trialDays" class="form-input form-input--sm" value="90" min="1" max="180">
                        </div>
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-label" for="empNotes">ملاحظات داخلية</label>
                        <textarea id="empNotes" class="form-textarea" rows="3" placeholder="ملاحظات اختيارية..."></textarea>
                    </div>
                </div>
            </div>

            {{-- Section D: Signature & Send --}}
            <div class="form-card">
                <div class="form-card__header">
                    <h2 class="form-card__title">التوقيع والإرسال</h2>
                    <span class="section-badge">4</span>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <div class="toggle-row">
                            <label class="form-label">التوقيع بـ OTP</label>
                            <label class="toggle">
                                <input type="checkbox" id="otpToggle" checked>
                                <span class="toggle__slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">قناة الإرسال الافتراضية</label>
                        <div class="radio-group">
                            <label class="radio-opt active">
                                <input type="radio" name="sendChannel" value="whatsapp" checked>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                واتساب
                            </label>
                            <label class="radio-opt">
                                <input type="radio" name="sendChannel" value="email">
                                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                                بريد إلكتروني
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="create-layout__sidebar">

            {{-- Summary Card --}}
            <div class="side-card" id="summaryCard">
                <h3 class="side-card__title">ملخص سريع</h3>
                <div class="summary-list">
                    <div class="summary-item"><span class="summary-label">الاسم</span><span class="summary-value" id="sumName">—</span></div>
                    <div class="summary-item"><span class="summary-label">الهوية</span><span class="summary-value" id="sumId">—</span></div>
                    <div class="summary-item"><span class="summary-label">الراتب</span><span class="summary-value" id="sumSalary">4,500 ر.س</span></div>
                    <div class="summary-item"><span class="summary-label">الموقع</span><span class="summary-value" id="sumSite">—</span></div>
                    <div class="summary-item"><span class="summary-label">البداية</span><span class="summary-value" id="sumStart">—</span></div>
                    <div class="summary-item"><span class="summary-label">النهاية</span><span class="summary-value" id="sumEnd">—</span></div>
                </div>
            </div>

            {{-- Checklist Card --}}
            <div class="side-card">
                <h3 class="side-card__title">قائمة التحقق</h3>
                <div class="checklist">
                    <div class="checklist-item" id="checkFields"><span class="checklist-icon">○</span> تم إدخال الحقول الأساسية</div>
                    <div class="checklist-item" id="checkGenerate"><span class="checklist-icon">○</span> تم توليد العقد</div>
                    <div class="checklist-item" id="checkSend"><span class="checklist-icon">○</span> تم إرسال الرابط</div>
                    <div class="checklist-item" id="checkSign"><span class="checklist-icon">○</span> تم التوقيع</div>
                </div>
            </div>

            {{-- Public Link Card --}}
            <div class="side-card" id="linkCard">
                <h3 class="side-card__title">الرابط العام</h3>
                <div class="link-box">
                    <input type="text" id="publicLinkInput" class="form-input form-input--link" readonly placeholder="سيتم إنشاؤه بعد توليد العقد" value="">
                    <button class="btn btn--outline btn--sm" id="btnCopyPublicLink" disabled>نسخ</button>
                </div>
                <div class="qr-placeholder" id="qrPlaceholder" style="display:none;">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="#cbd5e1"><rect x="2" y="2" width="8" height="8" rx="1"/><rect x="14" y="2" width="8" height="8" rx="1"/><rect x="2" y="14" width="8" height="8" rx="1"/><rect x="16" y="16" width="4" height="4" rx="0.5"/></svg>
                    <span>QR Code</span>
                </div>
            </div>

            {{-- Simulation Card --}}
            <div class="side-card side-card--simulation">
                <h3 class="side-card__title">محاكاة (للتطوير)</h3>
                <p class="side-card__note">لتجربة تغيير الحالة</p>
                <button class="btn btn--outline btn--sm btn--full" id="btnSimViewed" disabled>محاكاة: تمت المشاهدة</button>
                <button class="btn btn--outline btn--sm btn--full" id="btnSimSigned" disabled style="margin-top:8px;">محاكاة: تم التوقيع</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Preview PDF --}}
<div class="modal" id="previewModal">
    <div class="modal__overlay"></div>
    <div class="modal__content modal__content--lg">
        <div class="modal__header">
            <h2 class="modal__title">معاينة العقد</h2>
            <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
        <div class="modal__body">
            <div class="pdf-preview" id="pdfPreviewContent">
                <div class="a4-page">
                    <div class="a4-header">عقد عمل</div>
                    <div class="a4-line"><strong>اسم الموظف:</strong> <span id="prevName">—</span></div>
                    <div class="a4-line"><strong>رقم الهوية:</strong> <span id="prevId">—</span></div>
                    <div class="a4-line"><strong>المسمى الوظيفي:</strong> <span id="prevTitle">—</span></div>
                    <div class="a4-line"><strong>الراتب:</strong> <span id="prevSalary">—</span></div>
                    <div class="a4-line"><strong>موقع العمل:</strong> <span id="prevSite">—</span></div>
                    <div class="a4-line"><strong>الفرع:</strong> <span id="prevBranch">—</span></div>
                    <div class="a4-line"><strong>تاريخ البداية:</strong> <span id="prevStart">—</span></div>
                    <div class="a4-line"><strong>تاريخ النهاية:</strong> <span id="prevEnd">—</span></div>
                    <div class="a4-line"><strong>المدة:</strong> <span id="prevDuration">—</span></div>
                    <div class="a4-separator"></div>
                    <div class="a4-line" style="color:#94a3b8;font-size:12px">هذا عقد عمل بين الشركة والموظف المذكور أعلاه وفقاً لنظام العمل السعودي...</div>
                    <div class="a4-signatures">
                        <div><strong>توقيع الشركة</strong><div class="sig-line"></div></div>
                        <div><strong>توقيع الموظف</strong><div class="sig-line"></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إغلاق</button>
            <button class="btn btn--primary" id="previewDownloadBtn"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/></svg> تنزيل PDF</button>
        </div>
    </div>
</div>

{{-- Modal: Send Contract --}}
<div class="modal" id="sendModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">إرسال العقد للموظف</h2>
            <button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
        <div class="modal__body">
            <div class="form-group">
                <label class="form-label">قناة الإرسال</label>
                <div class="channel-options">
                    <label class="channel-opt active"><input type="radio" name="modalChannel" value="whatsapp" checked><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> واتساب</label>
                    <label class="channel-opt"><input type="radio" name="modalChannel" value="email"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg> بريد إلكتروني</label>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" id="sendContactLabel">رقم الجوال</label>
                <input type="text" id="sendContactInput" class="form-input" placeholder="05XXXXXXXX">
            </div>
            <div class="form-group">
                <label class="form-label">رسالة مخصصة</label>
                <textarea id="sendMessageInput" class="form-textarea" rows="3" placeholder="السلام عليكم، مرفق رابط عقد العمل الخاص بكم للاطلاع والتوقيع..."></textarea>
            </div>
            <div class="form-group">
                <label class="checkbox-label"><input type="checkbox" id="sendCopyAdmin"> إرسال نسخة للإدارة</label>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline modal__close">إلغاء</button>
            <button class="btn btn--primary" id="confirmSendBtn"><svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg> إرسال</button>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div class="modal" id="confirmModal">
    <div class="modal__overlay"></div>
    <div class="modal__content">
        <div class="modal__header"><h2 class="modal__title">تأكيد إعادة الضبط</h2><button class="modal__close" aria-label="إغلاق"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button></div>
        <div class="modal__body"><p>هل أنت متأكد من إعادة ضبط النموذج؟ سيتم مسح جميع البيانات والعودة لحالة المسودة.</p></div>
        <div class="modal__footer"><button class="btn btn--outline modal__close">إلغاء</button><button class="btn btn--danger" id="confirmResetBtn">إعادة ضبط</button></div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast" role="status" aria-live="polite">
    <svg class="toast__icon" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
    <span class="toast__message" id="toastMessage"></span>
</div>
@endsection

