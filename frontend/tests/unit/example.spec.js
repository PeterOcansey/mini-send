import { shallowMount } from '@vue/test-utils';
import DashboardView from '@/views/DashboardView.vue';

describe('DashboardView.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message';
    const wrapper = shallowMount(DashboardView, {
      propsData: { msg },
    });
    expect(wrapper.text()).toMatch(msg);
  });
});
